<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactRequest extends Request
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
            'name'    => 'required|between:3,100',
            'email'   => 'required|email',
            'phone'   => 'required',
            'subject' => 'required|between:3,60',
            'message' => 'required|between:10,500'
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => 'O campo nome é obrigatório',
            'name.between'     => 'O campo nome deve conter entre 3 e 100 caracteres',
            'email.required'   => 'O campo email é obrigatório',
            'email.email'      => 'O campo email não contém um formato válido',
            'phone.required'   => 'O campo telefone é obrigatório',
            'subject.required' => 'O campo nome é obrigatório',
            'subject.between'  => 'O campo mensagem deve conter entre 3 e 60 caracteres',
            'message.required' => 'O campo mensagem é obrogatório',
            'message.between'  => 'O campo mensagem deve conter entre 10 e 500 caracteres'
        ];
    }
}
