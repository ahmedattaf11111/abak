<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function store(FaqRequest $request){
        Faq::create($request->validated());
    }
    public function update(FaqRequest $request){
        Faq::find($request->id)->update($request->validated());
    }
    public function delete($id)
    {
        Faq::destroy($id);
    }
    public function index()
    {
        return Faq::when(request()->text, function ($q) {
            $q->where("question", "like", "%" . request()->text . "%");
        })->orderBy("id","desc")->paginate(request()->page_size);
    }
    public function find($id){
        return Faq::find($id);
    }
}
