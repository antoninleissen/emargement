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

Route::group(['middleware' => []], function () {

    // USER SECTION
    Route::get('account/whoAmI', 'Api\AccountController@getWhoAmI');
//    Route::get('pac/listByOwner', 'Api\PacController@listByOwner');
    Route::get('account/getAccount', 'Api\AccountController@getAccount');
    Route::resource('account', 'Api\AccountController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
    Route::resource('test', 'Api\TestController', ['only' => ['index', 'show', 'update', 'store', 'destroy']]);
});
