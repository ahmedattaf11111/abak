<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function store(ServiceRequest $request){
        Service::create($request->validated());
    }
    public function update(ServiceRequest $request){
        Service::find($request->id)->update($request->validated());
    }
    public function delete($id)
    {
        Service::destroy($id);
    }
    public function index()
    {
        return Service::when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->orderBy("id","desc")->paginate(request()->page_size);
    }
    public function find($id){
        return Service::find($id);
    }
}
