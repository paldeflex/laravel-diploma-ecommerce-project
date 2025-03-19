<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Регистрация - Снежинские краски')]
class RegisterPage extends Component
{
    public $name;

    public $email;

    public $password;

    public function save()
    {
        $validated =
            $this->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:6|max:255',
            ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
