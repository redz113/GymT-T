<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
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
            'time_name' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'time_name.required' => 'Không để trống tên ca tập',
            'start_time.required' => 'Chọn thời gian bắt đầu ca',
            'end_time.required' => 'Chọn thời gian kết thúc ca',
        ];

    }
}
