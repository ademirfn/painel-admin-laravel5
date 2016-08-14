<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $email_rule = 'required|email|max:255|unique:users,';
        if($this->has('id')){
            $email_rule = 'required|email|max:255|unique:users,email,' . $this->get('id');
        }
        return [ 
            'email'    => $email_rule,
            'password' => 'required|confirmed|between:6,12',  
            'role_id'  => 'required|integer'
        ];
    }

    public function messages()
    {        
        return [            
            'email.required'     => 'O campo email é obrigatório',
            'email.unique'       => 'O valor do campo email já está sendo utilizado',
            'password.required'  => 'O campo senha é obrigatório',
            'password.confirmed' => 'O campo repita senha deve conter o mesmo valor de senha',
            'password.between'   => 'O valor do campo senha deve conter entre 6 e 12 caracteres',
            'role_id.required'   => 'O campo papel do usuário é obrigatório',
            'role_id.integer'    => 'O campo papel do usuário deve conter um numero'
        ];
    }
}
