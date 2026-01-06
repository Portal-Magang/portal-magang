<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();
    
        $login = $this->input('login');
        $password = $this->input('password');
    
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        $user = User::where($field, $login)->first();
    
        if (! $user) {
            RateLimiter::hit($this->throttleKey());
    
            throw ValidationException::withMessages([
                'login' => 'Email atau username salah.',
            ]);
        }
    
        if (! Hash::check($password, $user->password)) {
            RateLimiter::hit($this->throttleKey());
    
            throw ValidationException::withMessages([
                'password' => 'Password salah.',
            ]);
        }
    
        Auth::login($user, $this->boolean('remember'));
        RateLimiter::clear($this->throttleKey());
    }    

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')).'|'.$this->ip());
    }
}