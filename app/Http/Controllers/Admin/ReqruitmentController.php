<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\Models\Reqruitment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReqruitmentController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function delete($id)
    {

        $req = Reqruitment::find($id);
        if ($req) {
            Storage::delete($req->getImageName());
            $req->delete();
        }
    }

    public function index()
    {
        return Reqruitment::when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->orderBy("id","desc")->paginate(request()->page_size);
    }
 

}
