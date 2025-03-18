<?php

namespace App\Livewire\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Вход - Снежинские краски')]
class LoginPage extends Component
{
    public $email;
    public $password;

    public function save(): ?RedirectResponse
    {
        $validated = $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        if (Auth::attempt($validated)) {
            session()->regenerate();
            return redirect()->intended();
        }

        session()->flash('error', 'Данные введены неверно, попробуйте ещё раз');
        return null;
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
