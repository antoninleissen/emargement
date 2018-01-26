<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends ApiWithAccountController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'company_name' => 'required|string',
        'address' => 'required|string',
        'complement' => 'string',
        'cp' => 'required|string',
        'city' => 'required|string',
        'country' => 'required|string',
        'phone' => 'required|string'
    ];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Customer::class;
    }

    protected function enhanceSearchQuery(Request $request, $query)
    {
        $account = Auth::user();

        if (empty($account) || empty($account->type) || $account->type === 'customer') {
            $query->where(DB::raw('0'));
            return $query;
        }

        switch ($account->type) {
            case 'technician':
                // Check interventions
                $query
                    ->whereIn('id', function($query) use ($account) {
                        $query->select('accounts.role_id')
                            ->from('accounts')
                            ->join('pac_owners', 'accounts.id', 'pac_owners.account_id')
                            ->join('interventions', 'interventions.pac_id', 'pac_owners.pac_id')
                            ->where('interventions.technician_id', $account->role_id)
                            ->where('accounts.role_type', Customer::class)
                            ->groupBy('accounts.role_id');
                    });

                break;

            case 'sta':
                $query
                    ->whereIn('id', function($query) use ($account) {
                        $query->select('accounts.role_id')
                            ->from('accounts')
                            ->join('pac_owners', 'accounts.id', 'pac_owners.account_id')
                            ->join('maintenances', 'maintenances.pac_id', 'pac_owners.pac_id')
                            ->where('maintenances.company_id', $account->role_id)
                            ->where('accounts.role_type', Customer::class)
                            ->groupBy('accounts.role_id');
                    });
                break;

            case 'admin':
                break;
        }

        return $query;
    }
}
