<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            //
            'name' => 'required|unique:sliders|max:255|min:4',
            'description' => 'required',
            'image_path' => 'required',
        ];
    }

    //customize messages
    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên đã tồn tại',
            'name.max' => 'Tên không được phép quá 255 ký tự',
            'name.min' => 'Tên không được phép dưới 4 ký tự',

            'description.required' => 'Mô tả slider không được phép để trống',

            'image_path.required' => 'Hình ảnh không được phép để trống',

        ];
    }
}