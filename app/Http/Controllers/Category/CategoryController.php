<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Category;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Categories in DB
        $categories = Category::all();
        
        //JSON 200(ok)
        return $this->showAll($categories);
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
            'section_id' => 'required',     
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();

        // Creates Section
        $category = Category::create($data);

        // JSON 201(Created)
        return $this->showOne($category, 201);
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
        $category = Category::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($category);
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
        $category = Category::findOrFail($id);
        
        // Validate input
        $rules = [
            'name' => 'required',
            'section_id' => 'required',      
        ];
        
        if ($request->has('name')) {
            $category->name = $request->name;
        }
        
        if ($request->has('section_id')) {
            $category->section_id = $request->section_id;
        }
        
        if (!$category->isDirty()) {
            // JSON 422()
            return $this->errorResponse('You need to specify a diffrent value to update code', 422);
        }
        
        $category->save();
        
        // JSON 200(200)
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Category from DB
        $category = Category::findOrFail($id);
        
        $category->delete();
        
        // JSON (ok)
        return $this->showOne($category);
    }
}
