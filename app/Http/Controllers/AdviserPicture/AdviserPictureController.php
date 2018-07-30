<?php

namespace App\Http\Controllers\AdviserPicture;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\AdviserPicture;


class AdviserPictureController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all AdviserPicture in DB
        $adviserpictures = AdviserPicture::all();
        
        //return view('test')->withPictures($adviserpictures);
        //JSON 200(ok)
        return $this->showAll($adviserpictures);
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
            //'picture' => 'required|image',      
        ];

        $pictures = count($request->picture);
        foreach(range(0, $pictures) as $index) {
            $rules['picture.' . $index] = 'image';
        }
        
        $this->validate($request, $rules);

        $data = $request->all();

        foreach ($request->picture as $pictures) {
            //$data['picture'] = $pictures->store('');
            //$adviserpiture = AdviserPicture::create($data);
            AdviserPicture::create([
                'order_id' => $request->order_id,
                'picture' => $pictures->store(''),
            ]);
        }
        //$data['picture'] = $request->picture->store('');   
        
        // Creates AdviserPiture
        $adviserpiture = new AdviserPicture;

        //return view('test');
        // JSON 201(Created)
        return $this->showOne($adviserpiture, 201);
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
        $adviserpiture = AdviserPicture::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($adviserpiture);
    }

   
}
