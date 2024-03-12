<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'content_post' => 'required|max:12000',
            'subject_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Không để trống tiêu đề bài viết',
            'content_post.required' => 'Không để trống nội dung bài viết',
            'content_post.max' => 'Nội dung bài viết không được quá dài',
            'subject_id.required' => 'Chọn môn tập',
        ];

    }
}
