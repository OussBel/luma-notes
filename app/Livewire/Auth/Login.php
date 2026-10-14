<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function authenticate()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $this->remember)) {
            request()->session()->regenerate();

            return redirect()->intended('/board');
        }

        $this->addError('email', 'The provided credentials do not match.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
