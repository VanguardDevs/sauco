<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatesCreateRequest extends FormRequest
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
            'code' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el nombre del estado',
            'code.required' => 'Ingrese un código para el estado',
        ];
    }
}
