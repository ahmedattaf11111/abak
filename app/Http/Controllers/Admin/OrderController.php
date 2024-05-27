<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Mail\Email;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function find($id)
    {
        return Order::with(["service"])->find($id);
    }

    public function delete($id)
    {
        $order = Order::find($id);
        foreach ($order->files as $file) {
            Storage::delete($file["file"]);
        }
        $order->delete();
    }
    public function update(UpdateOrderRequest $request)
    {
        $order = Order::find($request->id);
        if ($request->status) {
            $oldStatus = $this->getStatus($order->status);
            $newStatus = $this->getStatus($request->status);
            Mail::to($order->email)->send(new Email([
                "title" => "تحديث حالة الطلب",
                "message" => "لقد تم تحديث حالة الطلب رقم $order->id من $oldStatus الى $newStatus",
                "url" => request()->url,
                "button_label" => request()->button_label
            ]));
            $order->status = $request->status;
        }
        if ($request->note) {
            $order->note = $request->note;
        }
        if ($request->file("file")) {
            $file = ["file_name" => $request->file_name, "file" => $request->file("file")->store("")];
            $order->files = array_merge($order->files, [$file]);
            Mail::to($order->email)->send(new Email([
                "title" => "ارفاق تقرير جديد",
                "message" => "لقد تم ارفاق تقرير جديد للطلب رقم $order->id",
                "url" => request()->url,
                "button_label" => request()->button_label
            ]));
        }
        $order->save();
    }

    public function index()
    {
        return Order::when(request()->text, function ($q) {
            $q->where("name", "like", "%" . request()->text . "%");
        })->with("service")->orderBy("id","desc")->paginate(request()->page_size);
    }
    //commons
    private function getStatus($status)
    {
        if ($status == 1) {
            return "اسلام الطلب";
        }
        if ($status == 2) {
            return "تحت الدراسة";
        }
        if ($status == 3) {
            return "قيد التنفيذ";
        }
        if ($status == 4) {
            return "مكتمل";
        }
    }
}
