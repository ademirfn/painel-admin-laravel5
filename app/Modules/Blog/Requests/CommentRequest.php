<?php

namespace App\Modules\Blog\Requests;

use App\Http\Requests\Request;

class CommentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {                
        return [                
            'description' => 'required|between:3,700',    
            'evaluation'  => 'required|integer',
            'user_id'     => 'required|integer',
            'post_id'     => 'required|integer'
        ];
    }

    public function messages()
    {
        return [            
            'description.required' => 'O campo comentário é obrigatório',
            'description.between'  => 'O campo comentário deve conter entre 3 e 700 caracteres',
            'evaluation.required'  => 'O campo avaliação é obrigatório',             
            'evaluation.integer'   => 'O campo avaliação deve ser um inteiro',   
            'user_id.required'     => 'O campo usuário é obrigatório',             
            'user_id.integer'      => 'O campo usuário deve ser um inteiro',
            'post_id.required'     => 'O campo artigo é obrigatório',             
            'post_id.integer'      => 'O campo artigo deve ser um inteiro'
        ];
    }
}
