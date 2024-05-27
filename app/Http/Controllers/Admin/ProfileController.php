<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Category;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function store(ProfileRequest $request)
    {
        $images = [];
        if ($request->file("images")) {
            foreach ($request->file("images") as $file) {
                $images[] = $file->store("");
            }
        }
        $input = $request->validated();
        $input["image"] = $request->file("image")->store("");
        $input["images"] = $images;

        Profile::create($input);
    }
    public function update(ProfileRequest $request)
    {
        $profile = Profile::find($request->id);
        if ($request->file("images")) {
            foreach ($request->file("images") as $file) {
                $images[] = $file->store("");
            }
        }
        $input = $request->validated();
        $input["image"] = $request->file("image")->store("");
        $input["images"] = $images;
        Storage::delete($profile->image);
        foreach ($profile->images as $image) {
            Storage::delete($image);
        }
        $profile->update($input);
    }

    public function delete($id)
    {
        $profile = Profile::find($id);
        Storage::delete($profile->image);
        foreach ($profile->images as $image) {
            Storage::delete($image);
        }
        $profile->delete();
    }

    public function index()
    {
        return Profile::with("category")->when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->orderBy("id","desc")->paginate(request()->page_size);
    }
    public function getCategories()
    {
        return Category::get();
    }
    
    public function find($id)
    {
        return Profile::find($id);
    }

}
