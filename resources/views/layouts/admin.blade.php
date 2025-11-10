<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Lokalook</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-body antialiased">

    <div class="flex min-h-screen">
        <nav class="w-64 bg-white shadow-md">
            <div class="p-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('storage/images/lokalook-logo.png') }}" alt="Local Look Logo"
                        class="h-16 w-auto">
                </a>
            </div>

            <ul class="space-y-2 p-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-maroon text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-box"></i>
                        <span>Produk</span>
                    </a>
                </li>
            </ul>
        </nav>

        <main class="flex-1">
            <header class="bg-white shadow-sm">
                <div class="flex justify-end items-center p-4">
                    <div class="text-gray-700 font-medium">
                        Halo, {{ Auth::user()->name }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ml-4">
                        @csrf
                        <button type="submit" class="btn-outline-maroon text-sm py-2 px-4">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>
