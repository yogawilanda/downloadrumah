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

use App\Concerns\WithSanitization;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class RegisterForm extends Form
{
    use WithSanitization;

    public string $name = '';
    public string $email = '';
    public string $phone_number = '';
    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle user registration process.
     */
    public function store(): User
    {
        // Sanitasi seluruh input di baris pertama
        $this->name = $this->sanitizeText($this->name);
        $this->email = $this->sanitizeEmail($this->email);
        $this->phone_number = $this->sanitizePhone($this->phone_number);

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => [
                'required', 'string', 'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return $user;
    }
}
