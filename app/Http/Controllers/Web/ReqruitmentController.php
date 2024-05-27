<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreReqruitmentRequest;
use App\Mail\Email;
use App\Models\Admin;
use App\Models\Reqruitment;
use Illuminate\Support\Facades\Mail;

class ReqruitmentController extends Controller
{
    public function __construct()
    {
    }

    //Dashboard endpoints
    public function store(StoreReqruitmentRequest $request)
    {
        $input=$request->validated();
        $input["cv"] = $request->file("cv")->store("");
        $employee = Reqruitment::create($input);
        $admin = Admin::find(1);
        Mail::to($admin->email)->send(new Email([
            "title" => "خدمة توظيف",
            "message" => "لقد قام العميل $employee->name بارسال طلب توظيف",
        ]));
        return $employee;
    }
}
