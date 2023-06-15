<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class CategoryRequest extends FormRequest
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
        $name = $this->request->get("name");
        
        return [
            'name' => ['required', ValidationRule::unique('categories')->ignore($name,'name')],
            'parent_id' => 'required',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Tên không được để trống',
        'name.unique' => 'Tên không được trùng',
        'name.max' => 'Tên không được dài quá',
        'parent_id.required' => 'Chưa chọn danh mục',
    ];
}
}
