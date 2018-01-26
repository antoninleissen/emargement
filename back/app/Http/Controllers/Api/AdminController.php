<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;

class AdminController extends ApiWithAccountController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'first_name' => 'required|string',
        'last_name' => 'required|string'
    ];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Admin::class;
    }
}
