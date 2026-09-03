<?php

/**
 * <meta_config>
 * @path : app/Livewire/Forms/RegisterForm.php | usage: Livewire Form Object for User Registration
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|lowercase|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('required|string|max:20')]
    public string $phone_number = '';

    #[Validate('required|string|min:8|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle user registration process.
     */
    public function store(): User
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => strtolower(trim($this->email)),
            'phone_number' => $this->phone_number,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $user;
    }
}
