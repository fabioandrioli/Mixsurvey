<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGuestRequest extends FormRequest
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
    public function rules(){
        return [
            'name' => 'required|min:4|max:150',
            'email' => 'required_with:emailConfirmed|email|unique:users|same:emailConfirmed',
            'emailConfirmed' => 'required',
        ];
    }

     public function messages(){
        return [
            'name.required' => 'Preencha o campo Nome completo',
            'name.min' => 'Tamanho mínimo do nome requer 4 caracteres',
            'name.max' => 'Tamanho maximo aceito 150 caracteres',
            'email.required' => 'Preencha o campo email',
            'email.required_with' => 'Confirmação de email inválida',
            'email.email' => 'Email inválido',
            'emailConfirmed.required' => 'Confirme seu email',
            'email.same' => 'Email e confirmacão de email nao correspondem.',
            'email.unique' => 'Email já cadastrado.'
        ];
    }
}
