<?php

namespace App\Http\Requests;

use App\Rules\ImageSize;
use Illuminate\Foundation\Http\FormRequest;

class ChangeAvatarRequest extends FormRequest
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
     //       "avatar" => ["mimes:jpg,jpeg,bmp,png", "max:2000", new ImageSize(200, 200)]
        ];
    }
}
