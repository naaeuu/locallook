<x-guest-layout>
    @section('title', 'Daftar Akun Lokalook')

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold font-heading text-black">Daftar Akun</h2>
        <a href="{{ route('login') }}" class="text-sm font-semibold text-maroon hover:text-maroon-dark">Masuk</a>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <div class="mt-1">
                <input id="name" name="name" type="text" :value="old('name')" required autofocus
                    autocomplete="name" class="search-bar-input py-3" placeholder="Masukkan nama lengkapmu">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" :value="old('email')" required
                    autocomplete="username" class="search-bar-input py-3" placeholder="Contoh: email@anda.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</Blabel>
                <div class="mt-1">
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="search-bar-input py-3" placeholder="Buat password (min. 8 karakter)">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                Password</label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password" class="search-bar-input py-3" placeholder="Ulangi password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="btn-maroon w-full justify-center py-3 text-base">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
