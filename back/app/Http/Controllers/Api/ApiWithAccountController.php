<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class ApiWithAccountController extends ApiController
{
    /**
     * @param Request $request
     * @param $entity
     * @param array $initialAttributes
     * @return mixed
     */
    protected function enhanceEntityBeforeUpdate(Request $request, $entity, array $initialAttributes) {
        // Add validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(array('error' => $validator->messages()->all()), 500);
        }

        $account = $entity->account;
        $account->email = $request->get('email');
        $account->save();

        return $entity;
    }

    /**
     * @param Request $request
     * @param $entity
     * @return mixed|void
     */
    protected function callbackAfterStore(Request $request, $entity) {
        $accountManager = app()->make(Account::class);
        $accountManager->create([
            'role_type' => $this->getManagerClassName(),
            'role_id'   => $entity->id,
            'email'     => $request->get('email'),
            'password'  => '123456'
        ]);
    }
}
