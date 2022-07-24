<?php

namespace App\Http\Requests\VehicleModels;

use Illuminate\Foundation\Http\FormRequest;

class VehicleModelCreateFormRequest extends FormRequest
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
            'name' => 'required',
            'brand_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Descripción',
            'brand_id' => 'Marca'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese una :attribute',
            'brand_id.required' => 'Seleccione una :attribute'
        ];
    }

}
