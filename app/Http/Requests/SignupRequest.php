<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:30'],
            'password_confirm' => 'required|same:password',
            'gender' => ['required'],
            'phone' => 'required',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nhập vào họ và tên',
            'email.required' => 'Nhập vào email',
            'email.email' => 'Nhập đúng định dạng email',
            'password.min' => 'Mật khẩu tối thiểu 8 kí tự',
            'password.max' => 'Mật khẩu tối đa 30 kí tự',
            'password_confirm.same' => 'Mật khẩu phải trùng nhau',
            'password_confirm.required' => 'Nhập lại mật khẩu',
            'password.required' => 'Nhập vào mật khẩu',
            'phone.required' => 'Nhập vào số điện thoại',
            'gender.required' => 'Chọn giới tính',
            'address.required' => 'Nhập vào địa chỉ'
        ];
    }
}
