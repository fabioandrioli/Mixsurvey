<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|min:3|max:150',
            'email' => 'required|email|unique:users',
            'image' => 'image|nullable',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Preencha o campo nome',
            'email.required' => 'Preencha o campo email',
            'image.image' => 'So arquivo do tipo imagem é permitido',
            'role_id.required' => 'Nenhum papel selecionado',
        ];
    }
}
