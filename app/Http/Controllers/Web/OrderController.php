<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreOrderRequest;
use App\Mail\Email;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except("downloadReport","getServices");
    }

    public function store(StoreOrderRequest $request)
    {
        $input = $request->validated();
        $input["user_id"] = request()->user()->id;
        $input["files"]=[];
        $order = Order::create($input);
        Mail::to($order->email)->send(new Email([
            "title" => "طلب خدمة",
            "message" => "لقد قام العميل $order->name بارسال طلب جديد",
        ]));
        return $order;
    }
    public function getServices($categoryId)
    {
        return Service::whereRelation("categories", "categories.id", $categoryId)->get();
    }
    public function downloadReport($filename){
           $path = public_path('uploads/'.$filename);
           if (file_exists($path)) {
               return response()->download($path, $filename);
           } else {
               return response()->json(['error' => 'File not found'], 404);
           }
    }
}
