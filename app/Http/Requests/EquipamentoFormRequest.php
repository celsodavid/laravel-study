<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipamentoFormRequest extends FormRequest
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
        if ($this->request->has("cancel")) {
            return [];
        }

        return [
            'tipo' => 'required',
            'modelo' => 'required|max:15',
            'fabricante' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'tipo.required' => 'O TIPO do Equipamento deve ser preenchido',
            'modelo.required' => 'O MODELO do Equipamento deve ser preenchido',
            'modelo.max' => 'O campo MODELO pode conter no máximo 15 caracteres',
            'fabricante.required' => 'O FABRICANTE do Equipamento deve ser preenchido',
        ];
    }
}
