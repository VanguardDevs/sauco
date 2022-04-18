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
            'rif' => 'required|min:8|unique:taxpayers',
            'name' => 'required',
            'taxpayer_type_id' => 'required',
            'taxpayer_classification_id' => 'required',
            // 'municipality_id' => 'required',
            'parish_id' => 'required',
            'community_id' => 'required',
            // 'state_id' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rif.required' => 'Ingrese el RIF',
            'rif.unique' => 'El RIF ingresado ya ha sido registrado',
            'name.required' => 'Ingrese el nombre',
            'address.required' => 'Ingrese la dirección',
            'municipality_id.required' => 'Seleccione un municipio',
            'state_id.required' => 'Seleccione un estado',
            'parish_id.required' => 'Seleccione una parroquia',
            'taxpayer_type_id.required' => 'Seleccione el tipo de contribuyente',
            'taxpayer_classification_id.required' => 'Seleccione la clasificación del contribuyente',
        ];
    }
}
