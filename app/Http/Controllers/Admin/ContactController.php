<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\Models\Contact;
use App\Models\PriceService;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function delete($id)
    {
        Contact::destroy($id);
    }

    public function index()
    {
        return Contact::when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->orderBy("id","desc")->paginate(request()->page_size);
    }
 
}
