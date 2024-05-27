<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth");
    }
    
    public function getGalleries()
    {
        return Gallery::get();
    }

}
