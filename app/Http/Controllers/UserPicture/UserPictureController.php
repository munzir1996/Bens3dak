<?php

namespace App\Http\Controllers\UserPicture;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\UserPicture;

class UserPictureController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all UserPicture in DB
        $userpictures = UserPicture::all();
        
        //JSON 200(ok)
        return $this->showAll($userpictures);
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
             'picture' => 'required|image',      
         ];
         
         $this->validate($request, $rules);
 
         $data = $request->all();
         $data['picture'] = $request->picture->store('');
 
         // Creates AdviserPiture
         $userpicture = UserPicture::create($data);
 
         // JSON 201(Created)
         return $this->showOne($userpicture, 201);
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
         $userpicture = UserPicture::findOrFail($id);
         
         // JSON 200(ok)
         return $this->showOne($userpicture);
     }


}
