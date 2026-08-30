<div x-show="mode === 'login'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200 transform absolute top-0 w-full" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0">
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Selamat Datang! 👋</h1>
        <p class="text-xs text-gray-500 mt-1">Masuk untuk mengelola dan menemukan hunian di DownloadRumah.</p>
    </div>
    <form wire:submit="login" class="space-y-4">
        <div><label class="block text-xs font-semibold text-gray-700 mb-1">Email</label><input wire:model="loginForm.email" type="email" required placeholder="nama@email.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none"><x-input-error :messages="$errors->get('loginForm.email')" class="mt-1 text-xs" /></div>
        <div>
            <div class="flex items-center justify-between mb-1"><label class="block text-xs font-semibold text-gray-700">Password</label>@if (Route::has('password.request'))<a class="text-xs text-blue-600 font-semibold hover:underline" href="{{ route('password.request') }}" wire:navigate>Lupa Password?</a>@endif</div>
            <input wire:model="loginForm.password" type="password" required placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition outline-none"><x-input-error :messages="$errors->get('loginForm.password')" class="mt-1 text-xs" />
        </div>
        <label class="inline-flex items-center cursor-pointer"><input wire:model="loginForm.remember" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"><span class="ms-2 text-xs text-gray-600">Ingat Saya</span></label>
        <div class="pt-2"><button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-bold py-3.5 px-4 rounded-2xl shadow-lg shadow-blue-100 transition duration-150 flex items-center justify-center"><span class="text-sm">Masuk Sekarang</span></button></div>
    </form>
</div>
