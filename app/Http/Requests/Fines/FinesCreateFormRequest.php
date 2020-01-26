<?php

namespace App\Http\Requests\Fines;

use Illuminate\Foundation\Http\FormRequest;

class FinesCreateFormRequest extends FormRequest
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
            'fine_type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'fine_type' => 'tipo de multa'
        ];
    }

    public function messages()
    {
        return [
            'fine_type' => 'Seleccione el :attribute'
        ];
    }
}
