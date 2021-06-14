<?php

namespace App\Http\Requests\Permissions;

use Illuminate\Foundation\Http\FormRequest;

class PermissionsCreateFormRequest extends FormRequest
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
            'name' => 'required|unique:permissions',
            'slug' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'slug' => 'slug'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el :attribute',
            'slug.required' => 'Ingrese el :attribute',
        ];
    }
}
