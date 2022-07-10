<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientResquest extends FormRequest
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
     * Validando campos obrigatórios.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'between:2,50'],
            'cpf'       => ['required', 'string', 'size:11'],
            'mail'      => ['required', 'string'],
            'phone'     => ['required', 'string', 'max:11'],
            'address'   => ['required', 'string']
        ];
    }
}
