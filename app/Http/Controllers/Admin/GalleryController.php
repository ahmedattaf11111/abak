<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function store()
    {

        Gallery::create(["image" => request()->file("image")->store("")]);
    }
    public function find($id)
    {
        return Gallery::find($id);
    }
    public function update()
    {
        if (request()->file("image")) {
            $gallery = Gallery::find(request()->id);
            $oldImage = $gallery->image;
            Storage::delete($oldImage);
            $gallery->image = request()->file("image")->store("");
            $gallery->save();
        }
    }
    public function delete($id)
    {
        $category = Gallery::find($id);
        Storage::delete($category->image);
        $category->delete();
    }
    public function index()
    {
        return Gallery::orderBy("id", "desc")->paginate(request()->page_size);
    }
}
