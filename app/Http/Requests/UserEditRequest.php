<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "username"=>"required|string|max:40",
            "email"=>"nullable|email|max:40",
            "country"=>"exists:countries,id",
            "avatar"=>"file|mimes:jpg,jpeg,png|max:5120"
        ];
    }
}
