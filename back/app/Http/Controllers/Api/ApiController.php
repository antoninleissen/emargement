<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class ApiController extends Controller
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];
    protected $paginable = true;
    protected $manager;

    /** @return string */
    abstract protected function getManagerClassName();

    /**
     * @return Model
     */
    protected function getManager() {
        if (!isset($this->manager)) {
            $classname = $this->getManagerClassName();
            $this->manager = new $classname();
        }

        return $this->manager;
    }

    /**
     * @param $entity
     * @param $property
     * @return mixed
     */
    protected function formatDate($entity, $property) {
        if ($entity->$property !== null && $entity->$property !== 'null') {
            $date = new \DateTime($entity->$property);

            $timeZone = new \DateTimeZone('Europe/Paris');
            $date->setTimezone($timeZone);

            $entity->$property = $date->format('Y-m-d H:i:s');
        } else {
            $entity->$property = null;
        }

        return $entity;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit      = (int)$request->get('limit', 100);
        $order      = $request->get('order', array());

        $parameters = array_intersect_key(
            $request->all(),
            $this->parametersOperators
        );

        $manager = $this->getManager();
        $query = $manager->newQuery()->select($manager->getTable().'.*');

        foreach ($parameters as $key => $value) {
            if ($this->parametersOperators[$key] === 'LIKE') {
                $value = '%'.$value.'%';
            }

            $query->where($key, $this->parametersOperators[$key], $value);
        }

        $query = $this->enhanceSearchQuery($request, $query);

        if (!empty($order)) {
            if (isset($order['column'])) {
                if ( !in_array($order['column'], $this->allowedOrderColumns) ) {
                    return response()->json(array('error' => 'Invalid order column'), 500);
                }

                if (!isset($order['desc']) || !$order['desc']) {
                    $query->orderBy($order['column']);
                } else {
                    $query->orderBy($order['column'], 'desc');
                }
            }
        }

        if ($this->paginable) {
            $results = $query->paginate($limit);
        } else {
            $results = $query->get();
        }

        return response()->json($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->getManager()->findOrFail($id);
        return response()->json($result);
    }

    /**
     * @param Request $request
     * @param $entity
     * @return mixed
     */
    protected function enhanceEntityBeforeStore(Request $request, $entity) {
        return $entity;
    }

    /**
     * @param Request $request
     * @param $query
     * @return mixed
     */
    protected function enhanceSearchQuery(Request $request, $query) {
        return $query;
    }

    /**
     * @param Request $request
     * @param $entity
     * @return mixed
     */
    protected function callbackAfterStore(Request $request, $entity) {

    }

    /**
     * @param Request $request
     * @param $entity
     * @param array $initialAttributes
     */
    protected function callbackAfterUpdate(Request $request, $entity, array $initialAttributes) {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $parameters = $this->validateRequest($request);
        if (!is_array($parameters)) {
            return $parameters;
        }

        $manager = $this->getManager();
        $entity = $manager->newInstance($parameters);
        $entity = $this->enhanceEntityBeforeStore($request, $entity);
        $entity->save();
        $this->callbackAfterStore($request, $entity);

        return response()->json($entity);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    private function validateRequest(Request $request) {
        $parameters = [];
        foreach ($this->dataValidator as $key => $unused) {
            $parameters[$key] = $request->get($key);

            if ($parameters[$key] === null && isset($this->defaultParametersValue[$key])) {
                $parameters[$key] = $this->defaultParametersValue[$key];
            }
        }

        $parameters = array_intersect_key(
            $parameters,
            $this->dataValidator
        );

        $messages = [
            'required' => 'Le champs :attribute est requis.',
            'integer' => 'Le champs :attribute doit être correctement rempli.',
            'boolean' => 'Le champs :attribute doit être correctement rempli.',
            'string' => 'Le champs :attribute doit être correctement rempli.',
        ];

        $validator = Validator::make($parameters, $this->dataValidator, $messages);
        if ($validator->fails()) {
            return response()->json(array('error' => $validator->messages()->all()), 500);
        }

        return $parameters;
    }

    /**
     * @param Request $request
     * @param $entity
     * @param array $initialAttributes
     * @return mixed
     */
    protected function enhanceEntityBeforeUpdate(Request $request, $entity, array $initialAttributes) {
        return $entity;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $manager = $this->getManager();
        $entity = $manager->findOrFail($id);

        $parameters = $this->validateRequest($request);
        if (!is_array($parameters)) {
            return $parameters;
        }

        $parameters['id'] = $id;

        $initialAttributes = $entity->attributesToArray();
        foreach($parameters as $key => $value) {
            $entity->$key = $value;
        }

        $entity = $this->enhanceEntityBeforeUpdate($request, $entity, $initialAttributes);
        $entity->save();
        $this->callbackAfterUpdate($request, $entity, $initialAttributes);

        return response()->json($entity);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $manager = $this->getManager();
        $entity = $manager->findOrFail($id);
        $entity->delete();

        return response()->json($entity);
    }
}
