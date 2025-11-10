<header class="sticky top-0 z-50" x-data="{ open: false }">

    <div class="bg-nude text-maroon-dark text-sm py-1 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div>
                <a href="#" class="hover:underline">Gratis Ongkir</a>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('about') }}" class="hover:underline">Tentang Lokalook</a>
                <a href="#" class="hover:underline">Promo</a>
            </div>
        </div>
    </div>

    <nav class="bg-white shadow-md" aria-label="Main navigation">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center gap-4">

                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img src="{{ asset('storage/images/lokalook-logo.png') }}" alt="Local Look Logo"
                        class="h-12 md:h-14 w-auto">
                </a>

                <div class="flex-grow min-w-0">
                    {{--
                      UPDATE:
                      1. action="{{ route('products.index') }}" (Kirim ke halaman produk)
                      2. method="GET" (Metode pencarian)
                    --}}
                    <form action="{{ route('products.index') }}" method="GET" class="search-bar-wrapper">
                        <button type="submit" class="search-bar-button" aria-label="Cari">
                            <i class="fas fa-search"></i>
                        </button>
                        {{--
                          UPDATE:
                          1. name="search" (Key untuk data yang dikirim)
                          2. value="{{ request('search') }}" (Agar teks pencarian tidak hilang)
                        --}}
                        <input type="text" name="search" placeholder="Cari di Lokalook..." class="search-bar-input"
                            value="{{ request('search') }}">
                    </form>
                </div>

                <div class="md:hidden">
                    <button @click="open = !open" type="button"
                        class="text-maroon hover:text-maroon-dark focus:outline-none" aria-controls="navbarNavMobile"
                        :aria-expanded="open.toString()">
                        <span class="sr-only">Toggle navigation</span>
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="hidden md:flex items-center gap-4 flex-shrink-0">

                    {{-- DROPDOWN KERANJANG --}}
                    <div class="relative" x-data="{ cartOpen: false }" @mouseenter="cartOpen = true"
                        @mouseleave="cartOpen = false">
                        <a href="{{ route('cart.index') }}" class="cart-icon-wrapper" aria-label="Keranjang Belanja">
                            <i
                                class="fas fa-shopping-cart text-2xl text-gray-700 transition-colors duration-300 hover:text-maroon"></i>
                            <span class="cart-badge absolute -top-2 -right-2 hidden" aria-live="polite"
                                aria-atomic="true">0</span>
                        </a>
                        <div x-show="cartOpen" x-transition class="cart-hover-popup" style="display: none;">
                            <div id="cart-hover-content">
                                {{-- Konten dinamis dari cart.js --}}
                            </div>
                        </div>
                    </div>

                    @guest
                        <a href="{{ route('login') }}" class="btn-outline-maroon py-2 px-6 text-sm">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-maroon py-2 px-6 text-sm">Daftar</a>
                    @endguest

                    @auth
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-maroon">
                                <span>Halo, {{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition
                                class="absolute top-full right-0 z-10 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200"
                                style="display: none;">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex gap-6 overflow-x-auto whitespace-nowrap py-3 hide-scrollbar">
                <a href="{{ route('home') }}"
                    class="category-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('products.index') }}"
                    class="category-nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">Produk</a>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="md:hidden bg-white shadow-lg" id="navbarNavMobile">
        <ul class="flex flex-col space-y-2 p-4">
            @guest
                <li><a href="{{ route('register') }}" class="btn-maroon w-full text-center block py-2">Daftar</a></li>
                <li><a href="{{ route('login') }}" class="btn-outline-maroon w-full text-center block py-2">Masuk</a></li>
            @endguest
            @auth
                <li><span class="font-bold text-black text-lg px-2">Halo, {{ Auth::user()->name }}</span></li>
                <li><a href="{{ route('profile.edit') }}" class="nav-link-mobile">Profil Saya</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link-mobile w-full text-left !text-red-600">
                            Logout
                        </button>
                    </form>
                </li>
            @endauth
            <hr class="my-2">
            <li><a href="{{ route('home') }}"
                    class="nav-link-mobile {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('products.index') }}"
                    class="nav-link-mobile {{ request()->routeIs('products.index') ? 'active' : '' }}">Produk</a></li>
            <li><a href="{{ route('cart.index') }}"
                    class="nav-link-mobile relative {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                    Keranjang
                    <span class="cart-badge absolute top-1.5 left-20 hidden" aria-live="polite"
                        aria-atomic="true">0</span>
                </a></li>
            <hr class="my-2">
            <li><span class="font-bold text-gray-500 text-sm px-2">Kategori</span></li>
        </ul>
    </div>
</header>
