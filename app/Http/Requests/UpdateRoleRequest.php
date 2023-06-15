<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
            'name' => ['required', 'max:255', Rule::unique('roles')->ignore($name,'name')],
            'display_name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên vai trò không được để trống',
            'name.unique' => 'Tên vai trò đã tồn tại',
            'name.max' => 'Tên vai trò tối đa 255 ký tự',
            'display_name.required' => 'Mô tả vai trò không được để trống',
        ];
    }
}
