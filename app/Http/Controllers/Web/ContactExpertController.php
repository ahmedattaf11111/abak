<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreContactExpertRequest;
use App\Mail\Email;
use App\Models\Admin;
use App\Models\ContactExpert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactExpertController extends Controller
{
    public function __construct()
    {
    }

    public function store(StoreContactExpertRequest $request)
    {
        $input = $request->validated();
        $employee = ContactExpert::create($input);
        $admin = Admin::find(1);
        Mail::to($admin->email)->send(new Email([
            "title" => "خدمة الاستشارة",
            "message" => "لقد قام العميل $employee->name بارسال طلب استشارة",
        ]));

        return $employee;

    }
}
