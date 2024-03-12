<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BMIRequest extends FormRequest
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
            'weight' => 'required',
            'height' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => 'Không để trống cân nặng',
            'height.required' => 'Không để trống chiều cao',
        ];

    }
}
