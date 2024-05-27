<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        return Faq::when(request()->text, function ($q) {
            $q->where("question", "like", "%" . request()->text . "%");
        })->paginate(request()->page_size);
    }
}
