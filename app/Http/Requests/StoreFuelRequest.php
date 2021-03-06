<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Fuel;

class StoreFuelRequest extends FormRequest
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
            'fuel_name'=>'required|max:255|unique:fuels,name',
        ];
    }

    public function messages()
    {
        return [
            'fuel_name.required' => 'Моля въведете име!',
            'fuel_name.unique' => 'Този вид гориво вече съществува!',
        ];
    }
}
