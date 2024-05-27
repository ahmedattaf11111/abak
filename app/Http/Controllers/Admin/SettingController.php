<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Mail\Email;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    public function __construct()
    {
        // $this->middleware("auth:admin");

    }

    public function save(SettingRequest $request)
    {
        $setting = Setting::first();
        $setting->update($request->validated());
    }
    public function find()
    {
        return Setting::first();
    }
}
