<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyCreateRequest extends FormRequest
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
            'start_date' => 'required',
            'finish_date' => 'required',
            'image' => 'image',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Preencha o campo título',
            'title.min' => 'Tamanho mínimo do titulo requer 3 caracteres',
            'title.max' => 'Tamanho maximo aceito 150 caracteres',
            'description.required' => 'Tamanho maximo aceito 150 caracteres',
            'start_date.required' => 'Obrigatório data de ínicio',
            'finish_date.required' => 'Obrigatório data de fim',
            'image.image' => 'So arquivo do tipo imagem é permitido',
            'category_id.required' => 'Informe uma categoria',
        ];
    }
}
