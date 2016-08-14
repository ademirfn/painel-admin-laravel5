<?php

namespace App\Modules\Banners\Requests;

use App\Http\Requests\Request;

class BannerRequest extends Request
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
        $img_rule = 'required|image';
        if($this->has('id')){
            $img_rule = 'image';
        }
        return [
            'title'       => 'required|max:100',
            'subtitle'    => 'between:10,255',
            'description' => 'required|between:3,2000',
            'link'        => 'url',            
            'file'        => $img_rule
        ];
    }

    public function messages()
    {
        return [
            'title.required'   => 'O campo título é obrigatório',
            'title.max'        => 'O campo título deve conter no máximo 100 caracteres',            
            'subtitle.between' => 'O campo subtítulo deve conter entre 10 e 255 caracteres',  
            'link.url'         => 'O campo link não contém um formato válido',                     
            'file.required'    => 'O campo imagem é obrigatório',
            'file.image'       => 'O campo imagem não contém um formato válido'
        ];
    }
}
