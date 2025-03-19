<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Сброс пароля - Снежинские краски')]
class ResetPasswordPage extends Component
{
    public $token;

    #[Url]
    public $email;

    public $password;

    public $password_confirmation;

    public function mount($token): void
    {
        $this->token = $token;
    }

    public function save()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:255|confirmed',
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'token' => $this->token,
            ],
            function (User $user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->redirect('/login', navigate: true);
        }

        session()->flash('error', 'Что-то пошло не так');

        return null;
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
