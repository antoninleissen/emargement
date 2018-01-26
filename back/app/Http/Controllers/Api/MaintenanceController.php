<?php

namespace App\Http\Controllers\Api;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'pac_id'            => 'required',
        'company_id'        => 'required',
        'contract_number'   => 'required',
        'start_date'        => 'required',
        'stop_date'         => 'required',
    ];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Maintenance::class;
    }

    public function getMaintenancesByCompany(Request $request) {
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
