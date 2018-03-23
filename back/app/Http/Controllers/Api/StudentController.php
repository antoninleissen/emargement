<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 23/03/18
 * Time: 13:52
 */

namespace App\Http\Controllers\Api;


use App\Models\Student;

class StudentController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName()
    {
        return Student::class;

    }

}
