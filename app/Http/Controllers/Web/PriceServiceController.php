<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StorePriceServiceRequest;
use App\Mail\Email;
use App\Models\Admin;
use App\Models\PriceService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PriceServiceController extends Controller
{
    public function __construct()
    {
    }

    public function store(StorePriceServiceRequest $request)
    {

        $input = $request->validated();
        $employee = PriceService::create($input);
        $admin = Admin::find(1);
        Mail::to($admin->email)->send(new Email([
            "title" => "خدمة التسعير",
            "message" => "لقد قام العميل $employee->name بارسال طلب خدمة تسعير",
        ]));

        return $employee;
    }
}
