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

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name ?? '';

        // Pakai fallback string kosong '' agar tidak meng-assign null ke property bertipe string
        $this->username = $user->username ?? '';
        $this->brand_name = $user->brand_name ?? '';

        $this->email = $user->email ?? '';
        $this->phone_number = $user->phone_number ?? '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', Rule::unique(User::class)->ignore($user->id)],
            'brand_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\+\-\s\(\)]+$/'],
        ]);

        $validated['username'] = strtolower($validated['username']);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
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
    <header>
        <h2 class="text-base font-bold text-slate-800">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-xs font-semibold text-slate-500">
            {{ __('Perbarui informasi profil akun, alamat email, dan nomor kontak Anda.') }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-5">
        {{-- Nama Lengkap --}}
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-slate-700" />
            <x-text-input wire:model="name" id="name" name="name" type="text"
                class="mt-1 block w-full rounded-md border-slate-200 text-xs font-semibold text-slate-800 focus:border-blue-500 focus:ring-blue-500"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-1.5 text-xs font-medium text-rose-600" :messages="$errors->get('name')" />
        </div>

        {{-- Username Katalog (URL Slug) --}}
        <div>
            <x-input-label for="username" :value="__('Username Katalog (Tautan Unik)')"
                class="text-xs font-bold text-slate-700" />
            <div class="mt-1 flex rounded-md shadow-sm">
                <span
                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-slate-200 bg-slate-50 text-slate-500 text-xs font-medium">
                    /agen-properti/
                </span>
                <x-text-input wire:model="username" id="username" name="username" type="text"
                    class="rounded-l-none block w-full rounded-r-md border-slate-200 text-xs font-semibold text-slate-800 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="eayogawilanda" required autocomplete="username" />
            </div>
            <x-input-error class="mt-1.5 text-xs font-medium text-rose-600" :messages="$errors->get('username')" />
        </div>

        {{-- Nama Brand / Agensi --}}
        <div>
            <x-input-label for="brand_name" :value="__('Nama Brand / Agensi (Opsional)')"
                class="text-xs font-bold text-slate-700" />
            <x-text-input wire:model="brand_name" id="brand_name" name="brand_name" type="text"
                class="mt-1 block w-full rounded-md border-slate-200 text-xs font-semibold text-slate-800 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Yoga Wilanda Property" autocomplete="brand_name" />
            <p class="mt-1 text-[11px] text-slate-400">Jika dikosongkan, sistem akan menggunakan Nama Lengkap Anda.</p>
            <x-input-error class="mt-1.5 text-xs font-medium text-rose-600" :messages="$errors->get('brand_name')" />
        </div>

        {{-- Alamat Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold text-slate-700" />
            <x-text-input wire:model="email" id="email" name="email" type="email"
                class="mt-1 block w-full rounded-md border-slate-200 text-xs font-semibold text-slate-800 focus:border-blue-500 focus:ring-blue-500"
                required autocomplete="username" />
            <x-input-error class="mt-1.5 text-xs font-medium text-rose-600" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-amber-50/80 border border-amber-200/60 rounded-md">
                    <p class="text-xs font-semibold text-amber-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button wire:click.prevent="sendVerification"
                            class="underline text-xs font-bold text-amber-900 hover:text-amber-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-emerald-700">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Nomor Telepon --}}
        <div>
            <x-input-label for="phone_number" :value="__('Nomor Telepon / WhatsApp')"
                class="text-xs font-bold text-slate-700" />
            <x-text-input wire:model="phone_number" id="phone_number" name="phone_number" type="tel"
                class="mt-1 block w-full rounded-md border-slate-200 text-xs font-semibold text-slate-800 focus:border-blue-500 focus:ring-blue-500"
                placeholder="081234567890" autocomplete="tel" />
            <x-input-error class="mt-1.5 text-xs font-medium text-rose-600" :messages="$errors->get('phone_number')" />
        </div>

        {{-- Action Button & Saved Status --}}
        <div class="flex items-center gap-4 pt-2">
            <x-primary-button
                class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-md shadow-sm shadow-blue-200 active:scale-95 transition">
                {{ __('Simpan Perubahan') }}
            </x-primary-button>

            <x-action-message class="me-3 text-xs font-bold text-emerald-600" on="profile-updated">
                {{ __('Tersimpan.') }}
            </x-action-message>
        </div>
    </form>
</section>
