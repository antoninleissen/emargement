<?php
/**
 * Created by PhpStorm.
 * User: herpreck
 * Date: 19/03/18
 * Time: 13:27
 */

namespace App\Http\Controllers\Api;


use App\Models\Lesson;

class LessonController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Lesson::class;
    }
}
