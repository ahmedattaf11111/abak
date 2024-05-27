<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function getStatistics()
    {
        $user = request()->user();
        $orders = Order::where("user_id", $user->id)->get();
        $countFiles = 0;
        foreach ($orders as $order) {
            $countFiles += count($order->files);
        }
        return ["orders_count" => $orders->count(), "files_count" => $countFiles];
    }
    public function getOrders()
    {
        $user = request()->user();
        return Order::with("service")->where("user_id", $user->id)->paginate(request()->page_size);
    }
    public function getOrder($id)
    {
        return Order::with("service")->find($id);
    }
}
