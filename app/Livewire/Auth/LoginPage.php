<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{
    public $email;

    public $password;

    public function save()
    {
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:255',
        ]);

        if (Auth::attempt($validated)) {
            session()->regenerate();

            return $this->redirectIntended(navigate: true);
        }

        session()->flash('error', 'Данные введены неверно, попробуйте ещё раз');

        return null;
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
