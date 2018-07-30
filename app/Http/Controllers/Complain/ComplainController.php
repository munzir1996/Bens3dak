<?php

namespace App\Http\Controllers\Complain;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Complain;

class ComplainController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all complains in DB
        $complains = Complain::all();
        
        //JSON 200(ok)
        return $this->showAll($complains);
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
            'content' => 'required',     
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();

        // Creates Section
        $complain = Complain::create($data);

        // JSON 201(Created)
        return $this->showOne($complain, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Search in DB
        $complain = Complain::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($complain);
    }

}
