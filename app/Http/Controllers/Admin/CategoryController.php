<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function store(CategoryRequest $request)
    {
        $input = $request->validated();
        $input["image"] = $request->file("image")->store("");
        $category = Category::create($input);
        if ($request->services_ids) {
            $category->services()->sync($request->services_ids);
        }
    }
    public function find($id){
        return Category::find($id);
    }
    public function update(CategoryRequest $request)
    {
        $input = $request->validated();
        if ($request->file("image")) {
            $input["image"] = $request->file("image")->store("");
        }
        $category = Category::find($request->id);
        Storage::delete($category->image);
        $category->update($input);
        if ($request->services_ids) {
            $category->services()->sync($request->services_ids);
        }
    }
    public function delete($id)
    {
        $category = Category::find($id);
        Storage::delete($category->image);
        $category->delete();
    }

    public function index()
    {
        return Category::when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->with("services")->orderBy("id","desc")->paginate(request()->page_size);
    }
    public function getServices(){
        return Service::get();
    }
}
