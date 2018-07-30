<?php

namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Section;

class SectionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all Sections in DB
        $sections = Section::all();
        
        //JSON 200(ok)
        return $this->showAll($sections);
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
            'description' => 'required',
            'icon' => 'required|image',      
        ];
        
        $this->validate($request, $rules);

        $data = $request->all();
        $data['icon'] = $request->icon->store('');

        // Creates Section
        $section = Section::create($data);

        // JSON 201(Created)
        return $this->showOne($section, 201);
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
        $section = Section::findOrFail($id);
        
        // JSON 200(ok)
        return $this->showOne($section);
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
        $section = Section::findOrFail($id);
        
        // Validate input
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'icon' => 'required|image',      
        ];
        
        if ($request->has('name')) {
            $section->name = $request->name;
        }
        
        if ($request->has('description')) {
            $section->description = $request->description;
        }

        if ($request->hasFile('icon')) {
            Storage::delete($section->icon);
            $section->image = $request->icon->store('');
        }
        
        if (!$section->isDirty()) {
            // JSON 422()
            return $this->errorResponse('You need to specify a diffrent value to update code', 422);
        }
        
        $section->save();
        
        // JSON 200(ok)
        return $this->showOne($section);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Section from DB
        $section = Section::findOrFail($id);

        Storage::delete($section->icon);
        
        $section->delete();
        
        // JSON 200(ok)
        return $this->showOne($section);
    }
}
