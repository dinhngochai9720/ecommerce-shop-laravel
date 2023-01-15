<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255|min:4',
            'price' => 'required',
            'category_id' => 'required',
            'content' => 'required',
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

            'price.required' => 'Giá không được phép để trống',

            'category_id.required' => 'Danh mục sản phẩm không được phép để trống',

            'content.required' => 'Miêu tả sản phẩm không được phép để trống',

        ];
    }
}