<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordRulesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['required','confirmed', Password::min(8)->letters()->numbers()->symbols(),],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.letters' => 'Password harus berupa kombinasi huruf, angka, dan simbol.',
            'password.numbers' => 'Password harus berupa kombinasi huruf, angka, dan simbol.',
            'password.symbols' => 'Password harus berupa kombinasi huruf, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ];
    }
}