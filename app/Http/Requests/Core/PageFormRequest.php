<?php

namespace App\Http\Requests\Core;

use App\Http\Requests\Request;

class PageFormRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'teaser' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'teaser.required' => 'Vui lòng nhập mô tả ngắn',
            'content.required' => 'Vui lòng nhập nội dung'
        ];
    }
}
