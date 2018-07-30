<?php

namespace App\Http\Controllers\Rate;

use App\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class RateController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Sections in DB
        $rates = Rate::all();
        
        //JSON 200(ok)
        return $this->showAll($rates);
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
            'order_id' => 'required',
            'rate' => 'required',     
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();

        // Creates Section
        $rate = Rate::create($data);

        // JSON 201(Created)
        return $this->showOne($rate, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        // JSON 200(ok)
        return $this->showOne($rate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        // Delete Rate from DB               
        $rate->delete();
                
        // JSON 200(ok)
        return $this->showOne($rate);
    }
}
