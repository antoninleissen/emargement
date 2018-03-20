<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 20/03/18
 * Time: 09:37
 */


namespace App\Http\Controllers\Api;


class SpeakerController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Speaker::class;
    }
}
