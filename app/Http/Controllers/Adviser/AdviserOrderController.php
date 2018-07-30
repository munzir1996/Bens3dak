<?php

namespace App\Http\Controllers\Adviser;

use App\Adviser;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AdviserOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Adviser $adviser)
    {
        $orders = $adviser->orders;

        // JSON 200(ok)
        return $this->showAll($orders);
    }

}
