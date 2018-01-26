<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => array('api', 'auth:api')], function () {

    // USER SECTION
    Route::get('account/whoAmI', 'Api\AccountController@getWhoAmI');
    Route::get('pac/listByOwner', 'Api\PacController@listByOwner');
    Route::get('account/getAccount', 'Api\AccountController@getAccount');
    Route::get('intervention/getInterventionsByTechnician', 'Api\InterventionController@getInterventionsByTechnician');
    Route::get('maintenance/getMaintenancesByCompany', 'Api\MaintenanceController@getMaintenancesByCompany');
    Route::get('technician/getTechniciansByCompany', 'Api\TechnicianController@getTechniciansByCompany');

    Route::resource('account', 'Api\AccountController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('admin', 'Api\AdminController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('company', 'Api\CompanyController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('customer', 'Api\CustomerController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('intervention', 'Api\InterventionController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('maintenance', 'Api\MaintenanceController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('pac', 'Api\PacController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('technician', 'Api\TechnicianController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
});
