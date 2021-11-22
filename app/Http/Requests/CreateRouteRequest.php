<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRouteRequest extends FormRequest
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
//             'from_node_id' => 'required|unique_with:edges,to_node_id|not_in:'. $request['to_node_id'],
//            'to_node_id' => 'required|unique_with:edges,from_node_id|not_in:' . $request['from_node_id'],
            'from_node_id' => 'required|unique_with:edges,to_node_id',
            'to_node_id' => 'required|unique_with:edges,from_node_id',
            'max_speed' => 'required|integer|between:0,500',
            'distance_in_km' => 'required|integer',
            'road_type' => 'required|integer',
        ];
    }
}
