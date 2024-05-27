<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreContactRequest;
use App\Mail\Email;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
    }

    public function store(StoreContactRequest $request)
    {

        $employee = Contact::create($request->validated());
        $admin = Admin::find(1);
        Mail::to($admin->email)->send(new Email([
            "title" => "تواصل معنا",
            "message" => "لقد قام العميل $employee->name بارسال طلب تواصل",
        ]));
        return $employee;
    }
}
