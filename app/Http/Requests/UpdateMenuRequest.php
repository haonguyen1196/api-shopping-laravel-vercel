<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;


class UpdateMenuRequest extends FormRequest
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
            'name' => ['required', ValidationRule::unique('menus')->ignore($name,'name')],
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
