<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Email;
use App\Models\Contact;
use App\Models\Order;
use App\Models\PriceService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SatisticController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");
    }
    public function sendEmail()
    {
        return [
            "users_count" => User::count(),
            "orders_count" => Order::count(),
            "services_count" => Service::count(),
        ];
    }
}
