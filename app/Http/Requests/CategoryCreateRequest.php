<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'title' => 'required|min:3|max:150',
            'description' => 'max:150',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Preencha o campo título',
            'description.max' => 'O limite máximo de caracteres é 150',
        ];
    }
}
