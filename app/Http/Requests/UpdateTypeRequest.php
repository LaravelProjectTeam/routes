<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
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
            // 'type_name'=>'required|unique:App\Models\Type,name'.$this->name->id, - Problem
            'hardship'=>'required|numeric|min:1|max:10'
        ];
    }

    public function messages()
    {
        return [
            'type_name.required' => 'Моля въведете име!',
            'type_name.unique' => 'Този тип вече съществува.',
            'hardship.required' => 'Моля въведете трудност!',
            'hardship.min' => 'Трудността трябва да бъде минимум 1.',
            'hardship.max' => 'Трудността трябва да бъде максимум 10.'
        ];
    }
}