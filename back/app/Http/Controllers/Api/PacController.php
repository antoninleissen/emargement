<?php

namespace App\Http\Controllers\Api;

use App\Models\Pac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PacController extends ApiController
{
    protected $parametersOperators = [
        'serial_number' => 'LIKE'
    ];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'serial_number'     => 'required',
        'starting_at'       => 'required',
    ];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Pac::class;
    }

    protected function enhanceSearchQuery(Request $request, $query)
    {
        $account = Auth::user();

        if (empty($account) || empty($account->type)) {
            $query->where(DB::raw('0'));
            return $query;
        }

        switch ($account->type) {
            case 'customer':
                $query->join('pac_owners', 'pacs.id', 'pac_owners.pac_id')
                    ->where('pac_owners.account_id', $account->id);
                break;

            case 'technician':
                // Check interventions
                $query->join('interventions', 'pacs.id', 'interventions.pac_id')
                    ->where('technician_id', $account->role_id);
                break;

            case 'sta':
                $query->join('maintenances', 'pacs.id', 'maintenances.pac_id')
                    ->where('company_id', $account->role_id);
                break;

            case 'admin':
                break;
        }

        return $query;
    }

    /**
     * @param Request $request
     * @param $entity
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    protected function callbackAfterStore(Request $request, $entity)
    {
        $validator = Validator::make($request->all(), [
            'owner_id'          => 'required',
            'user_id'           => 'required',
            'building_owner_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->messages()->all()), 500);
        }

        $entity->owner_id = $request->get('owner_id');
        $entity->user_id = $request->get('user_id');
        $entity->building_owner_id = $request->get('building_owner_id');
    }

    /**
     * @param Request $request
     * @param $entity
     * @param array $initialParameters
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    protected function callbackAfterUpdate(Request $request, $entity, array $initialParameters)
    {
        $this->callbackAfterStore($request, $entity);
    }

    public function listByOwner(Request $request) {
        $account = Auth::user();
        $account_id = $request->get('account_id');

        if ($account->type !== 'admin' && $account->id !== $account_id) {
            return response('Access denied', 401);
        }

        $limit      = (int)$request->get('limit', 100);
        $order      = $request->get('order', array());

        $manager = $this->getManager();
        $query = $manager->newQuery();

        $query->join('pac_owners', 'pacs.id', 'pac_owners.pac_id')
            ->where('pac_owners.account_id', $account->id);

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
        } else {
            $query->orderBy('id', 'desc');
        }

        if ($this->paginable) {
            $results = $query->paginate($limit);
        }

        return response()->json($results);
    }
}
