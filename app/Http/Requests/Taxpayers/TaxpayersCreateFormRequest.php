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
            'name'    => 'required',
            'taxpayer_type'    => 'required',
            'economic_sector'  => 'required',
            'community' => 'required',
            'fiscal_address' => 'required',
            'state' => 'required',
            'municipality' => 'required',
            'parish' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'rif'              => 'RIF del contribuyente',
            'name'    => 'nombre o razón social',
            'fiscal_address' => 'dirección fiscal',
            'type'    => 'tipo de contribuyente',
            'phone'   => 'número de teléfono del contribuyente',
            'economic_sector'  => 'sector económico',
            'state' => 'estado',
            'municipality' => 'municipio',
            'community' => 'comunidad',
            'taxpayer_type' => 'tipo de contribuyente',
            'parish' => 'parroquia',
        ];
    }

    public function messages()
    {
        return [
            'rif.required'              => 'Ingrese el :attribute',
            'name.required'    => 'Ingrese el :attribute',
            'fiscal_address.required' => 'Ingrese la :attribute',
            'type.required'    => 'Seleccione el :attribute',
            'economic_sector.required'  => 'Seleccione un :attribute',
            'phone.digits'     => 'El :attribute debe ser de 9 dígitos',
            'address.required' => 'Ingrese la :attribute del contribuyente',
            'community.required' => 'Seleccione un :attribute',
            'taxpayer_type.required' => 'Seleccione una :attribute',
            'state.required' => 'Seleccione un :attribute',
            'municipality.required' => 'Seleccione un :attribute',
            'parish.required' => 'Seleccione una :attribute',
        ];
    }
}
