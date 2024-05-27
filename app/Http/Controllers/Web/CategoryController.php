<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Profile;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth");
    }
    
    public function getCategories()
    {
        return Category::withCount("services as services_count")->get();
    }

}
