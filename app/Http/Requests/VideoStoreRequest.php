<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
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
            "title"=>"required|string|min:10|max:100",
            "description"=>"required|string|min:15|max:250",
            "video"=>"required|file|mimes:mp4|max:5120",
            "categories"=>"required|array|min:1",
            "categories.*"=>"required|exists:categories,id"
        ];
    }
}
