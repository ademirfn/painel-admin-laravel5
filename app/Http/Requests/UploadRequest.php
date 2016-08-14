<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UploadRequest extends Request
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
            'file' => 'required|array',
            'product_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'O campo imagem é obrigatório',
            'file.array'    => 'O campo imagem deve ser um vetor, informe o administrador do sistema.',
            'product_id.required' => 'O produto é obrigatório, informe o administrador do sistema.',
            'product_id.integer' => 'O produto deve conter um número, informe o administrador do sistema.'
        ];
    }
}
