<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 20/03/18
 * Time: 10:18
 */


namespace App\Http\Controllers\Api;


use App\Models\Classroom;

class ClassroomController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Classroom::class;
    }
}
