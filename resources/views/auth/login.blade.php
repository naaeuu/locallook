<x-guest-layout>
    @section('title', 'Masuk ke Lokalook')

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold font-heading text-black">Masuk ke Lokalook</h2>
        <a href="{{ route('register') }}" class="text-sm font-semibold text-maroon hover:text-maroon-dark">Daftar</a>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" :value="old('email')" required autofocus
                    autocomplete="username" class="search-bar-input py-3" placeholder="Contoh: email@anda.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required autocomplete="current-password"
                    class="search-bar-input py-3" placeholder="Masukkan password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-maroon shadow-sm focus:ring-maroon" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-maroon hover:text-maroon-dark"
                    href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="btn-maroon w-full justify-center py-3 text-base">
                Masuk
            </button>
        </div>
    </form>

    <div class="my-6 relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">atau masuk dengan</span>
        </div>
    </div>
    <div class="space-y-4">
        <button type="button" class="btn-outline-maroon w-full justify-center py-2 text-base font-normal">
            <i class="fab fa-google mr-2"></i> Google
        </button>
    </div>
</x-guest-layout>
