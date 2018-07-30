<?php

namespace App\Http\Controllers\Rate;

use App\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class RateOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Rate $rate)
    {
        $order = $rate->order;
        
        return $this->showOne($order);
    }

    

}
