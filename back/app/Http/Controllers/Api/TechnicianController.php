<?php

namespace App\Http\Controllers\Api;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends ApiWithAccountController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'first_name'    => 'required|string',
        'last_name'     => 'required|string',
        'company_id'    => 'required'
    ];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Technician::class;
    }

    protected function enhanceSearchQuery(Request $request, $query)
    {
        $account = Auth::user();

        if (empty($account) || empty($account->type) || $account->type === 'customer' || $account->type === 'technician') {
            $query->where(DB::raw('0'));
            return $query;
        }

        switch ($account->type) {
            case 'sta':
                $query->where('company_id', $account->role_id);
                break;

            case 'admin':
                break;
        }

        return $query;
    }

    public function getTechniciansByCompany (Request $request) {
        $account = Auth::user();
        $companyId = $request->get('companyId');

        if ($account->type !== 'admin' && $account->id !== $companyId) {
            return response('Access denied', 401);
        }

        $manager = $this->getManager();
        $query = $manager->newQuery();

        $query->where('company_id', $companyId);

        $results = $query->get();

        return response()->json($results);
    }
}
