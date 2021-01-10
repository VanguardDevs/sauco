<?php

namespace App\Http\Requests\Communities;

use Illuminate\Foundation\Http\FormRequest;

class CommunitiesCreateFormRequest extends FormRequest
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
            'parishes' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'parishes' => 'parroquias'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el :attribute',
            'parishes.required' => 'Ingrese una o más parroquias'
        ];
    }
}
