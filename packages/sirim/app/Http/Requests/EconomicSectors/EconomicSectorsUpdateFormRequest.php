<?php

namespace App\Http\Requests\EconomicSectors;

use Illuminate\Foundation\Http\FormRequest;

class EconomicSectorsUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'description' => 'descripción'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Ingrese una :attribute'
        ];
    }
}
