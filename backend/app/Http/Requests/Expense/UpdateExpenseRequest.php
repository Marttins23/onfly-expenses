<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => 'min:3',
            'value' => 'numeric|min:0',
            'date' => 'date|before_or_equal:today',
            'user_id' => 'exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'min' => "O campo ':attribute' deve conter pelo menos :min caracteres",
            'numeric' => "O campo ':attribute' deve ser um número.",
            'date' => "O campo ':attribute' deve ser uma data válida.",
            'date.before_or_equal' => "A data máxima permitida é a data atual.",
            'user_id.exists' => "Não existe nenhum usuário com o ID informado."
        ];
    }

    public function attributes(): array
    {
        return [
            'description' => 'descricao',
            'value' => 'valor',
            'date' => 'data',
            'user_id' => 'ID do usuário'
        ];
    }
}
