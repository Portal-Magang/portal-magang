<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'photo_profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'current_password' => ['required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()->symbols(),],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required_with' => 'Password saat ini wajib diisi.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.letters' => 'Password harus berupa kombinasi huruf, angka, dan simbol.',
            'password.numbers' => 'Password harus berupa kombinasi huruf, angka, dan simbol.',
            'password.symbols' => 'Password harus berupa kombinasi huruf, angka, dan simbol.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ];
    }
}