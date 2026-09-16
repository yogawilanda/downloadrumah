<?php
/**
 * resources/views/livewire/pages/auth/confirm-password.blade.php
 *
 * @version 1.1.6
 * @description Password confirmation view for protected application areas.
 *
 * Responsibilities:
 * - Collect the authenticated user's current password.
 * - Validate the password against the web guard.
 * - Store the password confirmation timestamp in session.
 * - Redirect the user to the intended destination.
 *
 * Notes:
 * - Authentication logic remains inside the Livewire Volt component.
 * - UI styling supports both light and dark appearance.
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(
            default: route('dashboard', absolute: false),
            navigate: true
        );
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-slate-600 dark:text-slate-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form wire:submit="confirmPassword">
        {{-- Password --}}
        <div>
            <x-input-label
                for="password"
                :value="__('Password')"
                class="text-slate-700 dark:text-slate-300"
            />

            <x-text-input
                wire:model="password"
                id="password"
                class="mt-1 block w-full
                       border-slate-300 bg-white text-slate-900
                       placeholder:text-slate-400
                       focus:border-sky-500 focus:ring-sky-500
                       dark:border-slate-700 dark:bg-slate-900
                       dark:text-slate-100 dark:placeholder:text-slate-600
                       dark:focus:border-sky-500 dark:focus:ring-sky-500"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <div class="mt-4 flex justify-end">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</div>
