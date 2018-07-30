<?php

namespace App\Http\Controllers\Section;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SectionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        $categories = $section->categories;

        return $this->showAll($categories);
    }

    
}
