<?php

namespace App\Http\Requests\CommercialRegisters;

use Illuminate\Foundation\Http\FormRequest;

class CommercialRegistersCreateFormRequest extends FormRequest
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
            'num'              => 'required|unique:commercial_registers',
            // 'volume'           => 'required',
            // 'case_file'        => 'required',
            'start_date'       => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'num'              => 'número del registro comercial',
            'volume'           => 'tomo del registro comercial',
            'case_file'        => 'expediente',
            'start_date'       => 'fecha inicio de las actividades'
        ];
    }

    public function messages()
    {
        return [
            'num.required'              => 'Ingrese el :attribute del contribuyente',
            'num.unique'                => 'Este :attribute se encuentra registrado',
            'volume.required'           => 'Ingrese el :attribute del contribuyente',
            'case_file.required'        => 'Ingrese el :attribute del contribuyente',
            'start_date.required'       => 'Ingrese :attribute del contribuyente'
        ];
    }
}
