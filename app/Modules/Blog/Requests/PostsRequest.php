<?php

namespace App\Modules\Blog\Requests;

use App\Http\Requests\Request;

class PostsRequest extends Request
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
        $title_rule = 'required|max:100|unique:post';
        if($this->has('id')){
            $title_rule = 'required|max:100|unique:post,title,'.$this->get('id');
        }
        
        return [            
            'title'        => $title_rule,            
            'subtitle'     => 'required|between:20,400',                    
            'content'      => 'required|min:300'    
        ];
    }

    public function messages()
    {
        return [            
            'title.required'       => 'O campo título é obrigatório',
            'title.max'            => 'O campo título deve conter no máximo 100 caracteres',             
            'title.unique'         => 'O campo valor do campo título já esta sendo utilizado',   
            'subtitle.required'    => 'O campo subtítulo é obrigatório',         
            'subtitle.between'     => 'O campo subtítulo deve conter entre 20 e 400 caracteres',
            'content.required'     => 'O campo conteúdo é obrigatório',
            'content.min'          => 'O campo conteúdo deve conter no mínimo 300 caracteres'         
        ];
    }
}
