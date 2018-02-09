<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Technician;
use Illuminate\Http\Request;

class AccountController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Account::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWhoAmI(Request $request)
    {
        $account = $request->user();

        $result = Account::findOrFail($account->id);
        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAccount(Request $request)
    {

        $role_id = $request->get('role_id');

        switch ($request->get('role_type')) {
            case 'customer':
                $role_type = Customer::class;
                break;

            case 'technician':
                $role_type = Technician::class;
                break;

            case 'admin':
                $role_type = Admin::class;
                break;

            case 'company':
                $role_type = Company::class;
                break;

            default :
                $role_type = $request->get('role_type');
                break;
        }

        $manager = $this->getManager();
        $query = $manager->newQuery();

        $query->where([
            ['role_id', '=', $role_id],
            ['role_type', '=', $role_type]
        ]);

        $result = $query->get();

        return response()->json($result);
    }

}
