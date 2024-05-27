<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
    }

    public function getCategories()
    {
        return Category::get();
    }

    public function getProfiles()
    {
        return Profile::when(request()->category_id, function ($q) {
            $q->when(request()->category_id, function ($q) {
                $q->where("category_id", request()->category_id);
            });
        })->paginate(request()->page_size);
    }
    public function find($id)
    {
        return Profile::find($id);
    }
}
