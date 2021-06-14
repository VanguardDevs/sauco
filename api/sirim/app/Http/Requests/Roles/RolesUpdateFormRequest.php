<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateFormRequest extends FormRequest
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
            'name'        =>  'required|unique:roles,name,'.$this->role->id,
            'permission'  =>  'required'
        ];
    }

    public function attributes()
    {
        return [
            'name'        =>  'Nombre',
            'permission'  =>  'Permisos'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         =>  'Ingrese el :attribute del rol',
            'name.unique'           =>  'El nombre del rol debe ser unico',
            'permission.required'   =>  'Seleccione los permisos para el rol'
        ];
    }
}
