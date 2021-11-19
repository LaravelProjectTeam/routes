<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFuelRequest extends FormRequest
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
            'fuel_name' => 'required|unique:fuels,name|max:255',
        ];
    }

    public function messages()
    {
        return [
            'fuel_name.required' => 'Моля въведете име!',
        ];
    }
}
