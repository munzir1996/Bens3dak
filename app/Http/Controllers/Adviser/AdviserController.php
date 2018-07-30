<?php

namespace App\Http\Controllers\Adviser;

use App\Adviser;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AdviserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Advisers in DB
        $advisers = Adviser::all();
        
        //JSON 200(ok)
        return $this->showAll($advisers);
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:advisers',
            'password' => 'required|min:6|confirmed',    
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verification_token'] = Adviser::generateVerificationCode();

        // Creates Adviser
        $adviser = Adviser::create($data);

        // JSON 201(Created)
        return $this->showOne($adviser, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Search in DB
        $adviser = Adviser::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($adviser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adviser $adviser)
    {
        $adviser = Adviser::findOrFail($id);
        
        // Validate input
        $rules = [
            'name' => 'required',
            'email' => 'email|unique:advisers,email'.$adviser->id,
            'password' => 'min:6|confirmed',
        ];
        
        if ($request->has('name')) {
            $adviser->name = $request->name;
        }
        
        if ($request->has('email')  && $adviser->email != $request->email) {
            $adviser->verified = Adviser::UNVERIFIED;
            $adviser->verification_token = Adviser::generateVerificationCode();
            $adviser->email = $request->email;
        }
        
        if ($request->has('password')) {
            $adviser->password = bcrypt($request->password);
        }

        if ($request->has('phone')) {
            $adviser->phone = $request->phone;
        }
        
        if (!$adviser->isDirty()) {
            // JSON 422()
            return $this->errorResponse('You need to specify a diffrent value to update code', 422);
        }
        
        $adviser->save();
        
        // JSON 200(200)
        return $this->showOne($adviser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Manager from DB
        $adviser = Adviser::findOrFail($id);
        
        $adviser->delete();
        
        // JSON 200(ok)
        return $this->showOne($adviser);
    }
}
