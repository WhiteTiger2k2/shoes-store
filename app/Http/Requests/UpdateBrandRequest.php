<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'slug' => 'required',
            'key' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Vui lòng nhập tên thương hiệu!",
            'slug' => "Vui lòng nhập slug!",
            'key' => "Vui lòng nhập key!",
        ];
    }
}
