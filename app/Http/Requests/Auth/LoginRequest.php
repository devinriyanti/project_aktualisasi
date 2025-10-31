<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi request login.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string', // boleh email atau username
            'password' => 'required|string',
        ];
    }

    /**
     * Proses autentikasi (boleh pakai email atau username)
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $login = $this->input('email'); // field form tetap "email"
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $this->merge([$fieldType => $login]);

        if (! Auth::attempt([$fieldType => $this->input($fieldType), 'password' => $this->input('password')], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Tangani rate limit login.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Kunci rate limit berdasarkan IP + input.
     */
    public function throttleKey(): string
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }
}
