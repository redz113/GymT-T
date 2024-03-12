<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>['required','max:255','min:5'],
            'email' => ['required', 'email', 'max:255','unique:users'],
            'password'=>['required','min:6','max:50'],
            'password_confirm' => 'required|same:password',
            // 'avatar' => [ 'mimes:jpeg,jpg,png,gif','required','image','max:5120'],
            // 'gender' => ['required'],
            // 'phone' => ['required','integer'],
            'address' => ['required'],

        ];
    }

    public function messages(){
        return [
            'required'=>':attribute không được bỏ trống',
            'name.max'=>':attribute tối đa 255 kí tự',
            'name.min'=>':attribute tối thiểu 5 kí tự',
            'email.email'=>'Nhập đúng định dạng email',
            'email.max'=>':attribute tối đa 255 kí tự',
            'email.unique'=>':attribute đã tồn tại',
           
            // 'avatar.image'=>':attribute bắt buộc là ảnh',
            // 'avatar.max'=>'Ảnh vượt quá 5mb',
            // 'avatar.mimes'=>'Phải là dạng ảnh',
            'address.required'=> "Đại chỉ không được để chống",
            'gender.required' => "Giới tính không được để chống",
        ];

    }
}
