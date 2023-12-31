<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMenuRequest extends FormRequest
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
            'name' => 'required|unique:menus|max:255',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Tên Menu không được để trống',
        'name.unique' => 'Tên Menu đã tồn tại',
        'name.max' => 'Tên Menu không được quá 255 ký tự',
    ];
}
}
