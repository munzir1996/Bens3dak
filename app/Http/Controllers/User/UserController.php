<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Users in DB
        $users = User::all();
        
        //JSON 200(ok)
        return $this->showAll($users);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED;
        $data['verification_token'] = User::generateVerificationCode();
        $data['block'] = User::UNBLOCKED_USER;

        // Creates User
        $user = User::create($data);

        // JSON 201(Created)
        return $this->showOne($user, 201);
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
        $user = User::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($users);
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
        $user = User::findOrFail($id);
        
        // Validate input
        $rules = [
            'name' => 'required',
            'phone' => 'integer',
            'email' => 'email|unique:users,email'.$user->id,
            'password' => 'min:6|confirmed',
            
        ];
        
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        
        if ($request->has('email')  && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        
        if ($request->has('block')) {
            if (!$user->isVerified()) {
                // JSON 409()
                return $this->errorResponse('Only verified users can modify the admin field', 409);
            }
            $user->block = $request->block;
        }
        
        if (!$user->isDirty()) {
            // JSON 422()
            return $this->errorResponse('You need to specify a diffrent value to update code', 422);
        }
        
        $user->save();
        
        // JSON 200(ok)
        return $this->showOne($users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete User from DB
        $user = User::findOrFail($id);
        
        $user->delete();
        
        // JSON (ok)
        return $this->showOne($users);
    }
}
