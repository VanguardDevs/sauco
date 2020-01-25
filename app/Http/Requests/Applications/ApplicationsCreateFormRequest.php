<?php

namespace App\Http\Requests\Applications;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationsCreateFormRequest extends FormRequest
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
            'type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'type' => 'tipo de solicitud'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Seleccione el :attribute'
        ];
    }
}
