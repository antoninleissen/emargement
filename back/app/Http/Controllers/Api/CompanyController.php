<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;

class CompanyController extends ApiWithAccountController
{
    protected $parametersOperators = [
        'name' => 'LIKE',
    ];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'name' => 'required|string',
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
        return Company::class;
    }
}
