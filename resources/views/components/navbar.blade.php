<nav class="navbar navbar-expand-lg sticky-top" aria-label="Main navigation">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('storage/images/lokalook-logo.png') }}" alt="Local Look Logo" style="height: 90px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" role="menu">
                <li class="nav-item" role="none">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}" role="menuitem">Beranda</a>
                </li>
                <li class="nav-item" role="none">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}" role="menuitem">Produk</a>
                </li>
                <li class="nav-item position-relative" role="none">
                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" href="{{ route('cart.index') }}" role="menuitem" aria-label="Keranjang Belanja">
                        Keranjang <span id="cart-badge" class="cart-badge d-none" aria-live="polite" aria-atomic="true">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
