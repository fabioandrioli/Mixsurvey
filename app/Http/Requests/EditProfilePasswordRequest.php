<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilePasswordRequest extends FormRequest
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
            'password' => 'min:8|required_with:passwordConfirmed|same:passwordConfirmed',
            'passwordConfirmed' => 'required',
        ];
    }

    public function messages(){
        return [
            'password.min' => 'Requer 8 caracteres.',
            'password.required' => 'Preencha o campo senha',
            'password.password' => 'password inválido',
            'passwordConfirmed.required' => 'Confirme sua senha',
            'password.same' => 'senha e a confirmacão da senha nao correspondem.',
        ];
    }
}
