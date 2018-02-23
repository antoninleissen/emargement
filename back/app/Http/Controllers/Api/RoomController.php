<?php

namespace App\Http\Controllers\Api;


use App\Models\Room;

class RoomController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Room::class;
    }
}