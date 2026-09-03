<?php

/**
 * <meta_config>
 * @path : app/Livewire/Pages/Auth/AuthModal.php | usage: Livewire Auth Component
 * @ruling : max line of code 80%, max doc 20% | max total lines = 100 | stepper : true | comment style : PHP Docblock
 * @overflow_action : IF total lines > 100, STOP generation and trigger refactoring using traits, components, DTOs, or forms.
 * </meta_config>
 *
 * @author yogawilanda <eayogawilanda@gmail.com>
 */

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\LoginForm;
use App\Livewire\Forms\RegisterForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class AuthModal extends Component
{
    public LoginForm $loginForm;
    public RegisterForm $registerForm;

    public function login(): void
    {
        $this->loginForm->authenticate();
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function register(): void
    {
        $this->registerForm->store();

        $this->redirect(route('home', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.auth-modal');
    }
}
