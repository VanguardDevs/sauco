<?php

namespace App\Http\Requests\Properties;

use Illuminate\Foundation\Http\FormRequest;

class PropertiesCreateFormRequest extends FormRequest
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
            'local' => 'required',
            'street' => 'required',
            'floor' => 'required',
            'cadastre_num' => 'required',
            'ownership_status' => 'required',
            'property_type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'local' => 'número o nombre',
            'street' => 'calle o avenida',
            'floor' => 'piso',
            'cadastre_num' => 'número catastral',
            'ownership_status' => 'estado de propiedad',
            'property_type' => 'tipo de inmueble'
        ];
    }

    public function messages()
    {
        return [
            'local.required' => 'Ingrese el :attribute',
            'street.required' => 'Ingrese el :attribute',
            'floor.required' => 'Ingrese el :attribute',
            'cadastre_num.required' => 'Ingrese el :attribute',
            'ownership_status.required' => 'Seleccione el :attribute',
            'property_type.required' => 'Seleccione el :attribute'
        ];
    }
}
