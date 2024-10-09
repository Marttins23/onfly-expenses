<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => "O campo ':attribute' é obrigatório",
            'min' => "O campo ':attribute' deve conter pelo menos :min caracteres",
            'confirmed' => "A confirmação do campo ':attribute' não confere.",
            'email' => "O endereço de email precisa ser um endereço válido.",
            'unique' => "Já existe um registro com esse mesmo :attribute"
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'password' => 'senha',
            'password_confirmation' => 'confirmação da senha'
        ];
    }
}
