<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxpayersCreateRequest extends FormRequest
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
            'rif' => 'required|min:12|max:12|unique:taxpayers',
            'name' => 'required',
            'address' => 'required',
            'taxpayer_type_id' => 'required',
            'taxpayer_classification_id' => 'required',
            'municipality_id' => 'required',
            'community_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese un nombre para el contribuyente',
            'address.required' => 'Ingrese la dirección del contribuyente',
            'rif.required' => 'Ingrese un nombre para el contribuyente',
            'rif.min' => 'El RIF debe tener 9 caracteres',
            'rif.max' => 'El RIF debe tener 9 caracteres',
            'rif.unique' => 'El RIF se encuentra registrado',
            'taxpayer_type_id.required' => 'Seleccione un tipo',
            'taxpayer_classification_id.required' => 'Seleccione una clasificación',
            'municipality_id.required' => 'Seleccione un municipio',
            'community_id.required' => 'Seleccione una comunidad',
        ];
    }
}
