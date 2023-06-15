<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSettingRequest extends FormRequest
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
        $config_key = $this->request->get("config_key");
        return [
            'config_key' => ['required', 'max:255', Rule::unique('settings')->ignore($config_key,'config_key')],
            'config_value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'config_key.required' => 'Không được để trống',
            'config_key.unique' => 'Nội dung này đã tồn tại',
            'config_key.max' => 'Nội dung này quá dài',
            'config_value.required' => 'Không được để trống',
        ];
    }
}
