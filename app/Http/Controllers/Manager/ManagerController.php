<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Manager;

class ManagerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Managers in DB
        $managers = Manager::all();
        
        //JSON 200(ok)
        return $this->showAll($managers);
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
            'email' => 'required|email|unique:managers',
            'password' => 'required|min:6|confirmed',      
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verification_token'] = Manager::generateVerificationCode();

        // Creates User
        $manager = Manager::create($data);

        // JSON 201(Created)
        return $this->showOne($manager, 201);
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
        $manager = Manager::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($manager);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manager = Manager::findOrFail($id);
        
        // Validate input
        $rules = [
            'name' => 'required',
            'email' => 'email|unique:managers,email'.$manager->id,
            'password' => 'min:6|confirmed',
        ];
        
        if ($request->has('name')) {
            $manager->name = $request->name;
        }
        
        if ($request->has('email')  && $manager->email != $request->email) {
            $manager->verified = Manager::UNVERIFIED;
            $manager->verification_token = Manager::generateVerificationCode();
            $manager->email = $request->email;
        }
        
        if ($request->has('password')) {
            $manager->password = bcrypt($request->password);
        }

        if ($request->has('phone')) {
            $manager->phone = $request->phone;
        }
        
        if (!$manager->isDirty()) {
            // JSON 422()
            return $this->errorResponse('You need to specify a diffrent value to update code', 422);
        }
        
        $manager->save();
        
        // JSON 200(ok)
        return $this->showOne($manager);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Manager from DB
        $manager = Manager::findOrFail($id);
        
        $manager->delete();
        
        // JSON 200(ok)
        return $this->showOne($manager);
    }
}
