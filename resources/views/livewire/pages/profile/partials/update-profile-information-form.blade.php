<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $username = '';
    public string $brand_name = '';
    public string $email = '';
    public string $phone_number = '';

    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name ?? '';
        $this->username = $user->username ?? '';
        $this->brand_name = $user->brand_name ?? '';
        $this->email = $user->email ?? '';
        $this->phone_number = $user->phone_number ?? '';
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'brand_name' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            'phone_number' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9\+\-\s\(\)]+$/',
            ],
        ]);

        $validated['username'] = strtolower($validated['username']);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>

    {{-- Section Heading --}}
    <header class="border-b border-slate-200 pb-4 dark:border-slate-800">
        <span class="block text-[9px] font-bold uppercase tracking-[0.14em] text-slate-400 dark:text-slate-500">
            Account Information
        </span>

        <h2 class="mt-1 text-sm font-bold text-slate-950 dark:text-white">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 max-w-lg text-[10px] leading-relaxed text-slate-500 dark:text-slate-400">
            {{ __('Perbarui informasi profil akun, alamat email, dan nomor kontak Anda.') }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-5">

        {{-- Nama Lengkap --}}
        <div>
            <x-input-label
                for="name"
                :value="__('Nama Lengkap')"
                class="text-[10px] font-bold uppercase tracking-wide text-slate-600 dark:text-slate-400"
            />

            <x-text-input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-1.5 text-[10px] font-medium text-red-600 dark:text-red-400"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- Username Katalog --}}
        <div>
            <x-input-label
                for="username"
                :value="__('Username Katalog (Tautan Unik)')"
                class="text-[10px] font-bold uppercase tracking-wide text-slate-600 dark:text-slate-400"
            />

            <div class="mt-1 flex">
                <span class="inline-flex shrink-0 items-center border border-r-0 border-slate-200 bg-slate-50 px-3 text-[10px] font-medium text-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-500">
                    /agen-properti/
                </span>

                <x-text-input
                    wire:model="username"
                    id="username"
                    name="username"
                    type="text"
                    class="block min-w-0 w-full border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                    placeholder="eayogawilanda"
                    required
                    autocomplete="username"
                />
            </div>

            <x-input-error
                class="mt-1.5 text-[10px] font-medium text-red-600 dark:text-red-400"
                :messages="$errors->get('username')"
            />
        </div>

        {{-- Nama Brand --}}
        <div>
            <x-input-label
                for="brand_name"
                :value="__('Nama Brand / Agensi (Opsional)')"
                class="text-[10px] font-bold uppercase tracking-wide text-slate-600 dark:text-slate-400"
            />

            <x-text-input
                wire:model="brand_name"
                id="brand_name"
                name="brand_name"
                type="text"
                class="mt-1 block w-full border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                placeholder="Yoga Wilanda Property"
                autocomplete="brand_name"
            />

            <p class="mt-1.5 text-[10px] leading-relaxed text-slate-400 dark:text-slate-500">
                Jika dikosongkan, sistem akan menggunakan Nama Lengkap Anda.
            </p>

            <x-input-error
                class="mt-1.5 text-[10px] font-medium text-red-600 dark:text-red-400"
                :messages="$errors->get('brand_name')"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label
                for="email"
                :value="__('Email')"
                class="text-[10px] font-bold uppercase tracking-wide text-slate-600 dark:text-slate-400"
            />

            <x-text-input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-1.5 text-[10px] font-medium text-red-600 dark:text-red-400"
                :messages="$errors->get('email')"
            />

            {{-- Email Verification --}}
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div class="mt-3 border-l-2 border-amber-500 bg-amber-50 p-3 dark:bg-amber-950/20">
                    <p class="text-[10px] font-semibold leading-relaxed text-amber-800 dark:text-amber-300">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button
                            wire:click.prevent="sendVerification"
                            type="button"
                            class="ml-1 font-bold underline underline-offset-2 hover:text-amber-600 dark:hover:text-amber-200"
                        >
                            {{ __('Kirim ulang email verifikasi') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-[10px] font-bold text-emerald-700 dark:text-emerald-400">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Nomor Telepon --}}
        <div>
            <x-input-label
                for="phone_number"
                :value="__('Nomor Telepon / WhatsApp')"
                class="text-[10px] font-bold uppercase tracking-wide text-slate-600 dark:text-slate-400"
            />

            <x-text-input
                wire:model="phone_number"
                id="phone_number"
                name="phone_number"
                type="tel"
                class="mt-1 block w-full border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-slate-950 focus:ring-0 dark:border-slate-700 dark:bg-slate-950 dark:text-white dark:focus:border-white"
                placeholder="081234567890"
                autocomplete="tel"
            />

            <x-input-error
                class="mt-1.5 text-[10px] font-medium text-red-600 dark:text-red-400"
                :messages="$errors->get('phone_number')"
            />
        </div>

        {{-- Actions --}}
        <div class="flex flex-wrap items-center gap-4 border-t border-slate-200 pt-5 dark:border-slate-800">

            <x-primary-button
                class="border border-slate-950 bg-slate-950 px-4 py-2.5 text-[10px] font-bold uppercase tracking-wide text-white transition hover:bg-slate-800 focus:bg-slate-800 focus:outline-none focus:ring-0 dark:border-white dark:bg-white dark:text-slate-950 dark:hover:bg-slate-200"
            >
                {{ __('Simpan Perubahan') }}
            </x-primary-button>

            <x-action-message
                class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400"
                on="profile-updated"
            >
                {{ __('Tersimpan.') }}
            </x-action-message>

        </div>

    </form>
</section>
