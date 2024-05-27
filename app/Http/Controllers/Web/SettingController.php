<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Requests\Web\StoreContactRequest;
use App\Mail\Email;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    public function __construct()
    {
    }
    public function find()
    {
        return Setting::first();
    }
}
