<?php

namespace App\Http\Requests\Vehicles;

use Illuminate\Foundation\Http\FormRequest;

class VehicleCreateFormRequest extends FormRequest
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
            'plate' => 'required',
            'body_serial' => 'required',
            'engine_serial' => 'required',
            'vehicleModel' => 'required',
            'vehicleParameter' => 'required',
            'color' => 'required',
            'vehicleClassification' => 'required',
            'weight' => 'numeric|min:0',
            'capacity' => 'numeric|min:0',
            'stalls' => 'numeric|min:0'
        ];
    }

    public function attributes()
    {
        return [
            'plate' => 'Placa',
            'body_serial' => 'Serial de la Carroceria',
            'engine_serial' => 'Serial del Motor',
            'vehicleParameter' => 'Parámetro',
            'vehicleModel' => 'Modelo',
            'color' => 'Color',
            'vehicleClassification' => 'Clasificación',
            'weight' => 'Peso',
            'capacity' => 'Capacidad',
            'stalls' => 'Puestos'
        ];
    }

    public function messages()
    {
        return [
            'plate.required' => 'Ingrese una :attribute',
            'body_serial.required' => 'Ingrese un :attribute',
            'engine_serial.required' => 'Ingrese un :attribute',
            'vehicleParameter.required' => 'Seleccione un :attribute',
            'vehicleModel.required' => 'Seleccione un :attribute',
            'color.required' => 'Seleccione un :attribute',
            'vehicleClassification.required' => 'Seleccione una :attribute',
            'weight.min' => ':attribute debe ser mayor o igual a cero',
            'capacity.min' => ':attribute debe ser mayor o igual a cero',
            'stalls.min' => ':attribute debe ser mayor o igual a cero'
        ];
    }

}
