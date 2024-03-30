<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoEditRequest extends FormRequest
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
            "title"=>"required|string|max:100",
            "description"=>"required|string|max:250",
            "categories"=>"required|array|min:1",
            "categories.*"=>"required|exists:categories,id"
        ];
    }
}
