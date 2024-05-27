<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "name" => "required",
            "name_en" => "required",
            "short_description" => "required",
            "short_description_en" => "required",
            "description" => "required",
            "description_en" => "required",
            "category_id" => "required",
            "image" => "required",
            "images" => "nullable",
        ];
    }
}
