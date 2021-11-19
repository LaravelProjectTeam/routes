<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFillingStationRequest extends FormRequest
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
//        todo: add unique except to others
        return [
            'name' => 'required|max:255|unique:filling_stations,name,' . request()->filling_station,
            'fuels' => 'array'
        ];
    }
}
