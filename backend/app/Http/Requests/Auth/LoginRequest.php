<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => "O campo ':attribute' é obrigatório",
            'email' => "O endereço de email precisa ser um endereço válido."
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'password' => 'senha'
        ];
    }
}
