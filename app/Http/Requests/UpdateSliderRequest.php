<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSliderRequest extends FormRequest
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
            'name' => ['required', Rule::unique('sliders')->ignore($name,'name')],
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.unique' => 'Tên không được trùng',
            'name.max' => 'Tên không được dài quá 255 kí tự',
            'description.required' => 'Mô tả không được để trống',
        ];
    }
}
