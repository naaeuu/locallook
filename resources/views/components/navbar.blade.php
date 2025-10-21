<nav class="navbar navbar-expand-lg sticky-top" style="background-color: var(--nude); box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 1030;" aria-label="Main navigation">    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Local Look</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Produk</a></li>
                <li class="nav-item position-relative">
                    <a class="nav-link" href="{{ route('cart.index') }}">Keranjang
                        <span id="cart-badge" class="cart-badge d-none">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
