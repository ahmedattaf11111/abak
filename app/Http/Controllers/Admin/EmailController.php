<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\Models\Contact;
use App\Models\PriceService;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function sendEmail()
    {
        Mail::to(request()->email)->send(new Email([
            "title" => request()->title,
            "message" => request()->message,
        ]));
    }
}
