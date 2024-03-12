<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'package_name' => 'required',
            'subject_id' => 'required',
            'price' => 'required',
            'description' => 'required|max:10000',
            'type_package' => 'required',
            'short_description' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'package_name.required' => 'Không để trống tên gói tập',
            'subject_id.required' => 'Không để trống môn tập',
            'price.required' => 'Không để trống giá gói tập',
            'description.required' =>'Không để trống mô tả gói tập',
            'short_description.required' => 'Không để trống mô tả ngắn gói tập',
            'type_package.required' => 'Không để trống kiểu gói tập',
            'description.max' => 'Mô tả gói tập không được quá dài',
        ];
    }
}
