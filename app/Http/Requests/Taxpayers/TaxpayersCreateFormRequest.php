<?php

namespace App\Http\Requests\Taxpayers;

use Illuminate\Foundation\Http\FormRequest;

class TaxpayersCreateFormRequest extends FormRequest
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
            'rif'              => 'required',
            'name' => 'required',
            'personal_firm' => 'required',
            'taxpayer_type_id' => 'required',
            'taxpayer_classification_id' => 'required',
            'community_id' => 'required',
            'fiscal_address' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'rif'              => 'RIF del contribuyente',
            'name'    => 'nombre o razón social',
            'personal_firm' => 'nombre de la empresa',
            'fiscal_address' => 'dirección fiscal',
            'taxpayer_type_id'    => 'tipo de contribuyente',
            'taxpayer_classification_id'    => 'clasificación',
            'community_id' => 'comunidad',
        ];
    }

    public function messages()
    {
        return [
            'rif.required'              => 'Ingrese el :attribute',
            'name.required'    => 'Ingrese el :attribute',
            'fiscal_address.required' => 'Ingrese la :attribute',
            'personal_firm.required' => 'Ingrese el :attribute',
            'community_id.required' => 'Seleccione un :attribute',
            'taxpayer_type_id.required' => 'Seleccione una :attribute',
            'taxpayer_classification_id.required' => 'Seleccione una :attribute',
        ];
    }
}
