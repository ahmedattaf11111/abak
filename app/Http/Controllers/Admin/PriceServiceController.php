<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\Models\PriceService;
use Illuminate\Support\Facades\Mail;

class PriceServiceController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function delete($id)
    {
        PriceService::destroy($id);
    }

    public function index()
    {
        return PriceService::when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->orderBy("id","desc")->paginate(request()->page_size);
    }
  
}
