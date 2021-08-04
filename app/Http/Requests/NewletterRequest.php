<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewletterRequest extends FormRequest
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
            'email' => 'email|min:3|max:190|unique:newletters',
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Preencha o campo email',
            'email.min' => 'Tamanho minímo exigido.',
            'email.max' => 'Atingiu o tamanho máximo permitido.',
            'email.email' => 'Email inválido.',
            'email.unique' => 'Email ja cadastrado'
        ];
    }
}
