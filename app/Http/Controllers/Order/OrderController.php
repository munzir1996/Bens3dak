<?php

namespace App\Http\Controllers\Order;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class OrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Orders in DB
        $orders = Order::all();
        
        //JSON 200(ok)
        return $this->showAll($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $rules = [
            'notes' => 'required',
            'location' => 'required',
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();

        // Creates Order
        $order = Order::create($data);

        // JSON 201(Created)
        return $this->showOne($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // JSON 200(ok)
        return $this->showOne($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // Delete Order from DB
        $order->delete();
        
        // JSON (ok)
        return $this->showOne($order);
    }
}
