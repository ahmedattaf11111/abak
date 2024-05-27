<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "instgram" => "nullable",
            "facebook" => "nullable",
            "twitter" => "nullable",
            "linkedin" => "nullable",
            "youtube" => "nullable",
            "location" => "nullable",
            "work_deadline_one" => "nullable",
            "work_deadline_tow" => "nullable",
            "work_deadline_three" => "nullable",
        ];
    }
}


