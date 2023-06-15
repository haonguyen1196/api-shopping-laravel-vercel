<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'required|unique:products|max:255',
            'price' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Tên sản phẩm không được bỏ trống.',
        'name.unique' => 'Tên sản phẩm không được trùng.',
        'name.max' => 'Tên sản phẩm không quá dài.',
        'price.required' => 'Giá sản phẩm không được bỏ trống.',
        'content.required' => 'Content không được bỏ trống.',
        'category_id.required' => 'Danh mục không được bỏ trống.',
    ];
}
}
