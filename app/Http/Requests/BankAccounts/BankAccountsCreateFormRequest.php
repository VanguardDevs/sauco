<?php

namespace App\Http\Requests\BankAccounts;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountsCreateFormRequest extends FormRequest
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
            'bank_name' => 'required',
            'account_type' => 'required',
            'account_num' => 'required',
            'description' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'bank_name' => 'nombre del banco',
            'account_type' => 'tipo de cuenta',
            'account_num' => 'número de cuenta',
            'description' => 'descripción',
        ];
    }

    public function messages()
    {
        return [
            'bank_name.required' => 'Ingrese el :attribute',
            'account_type.required' => 'Seleccione el :attribute',
            'account_num.required'=> 'Ingrese el :attribute',
            'description.required' => 'Ingrese el :attribute',
        ];
    }
}
