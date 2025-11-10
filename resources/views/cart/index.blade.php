@extends('layouts.main')

@section('title', 'Keranjang Belanja')

@section('content')
    {{--
  Menambahkan 'cart-page-data' untuk dibaca oleh cart-page.js
  data-auth: Memberi tahu JS apakah user sudah login
  data-csrf: Memberi token keamanan untuk form checkout
--}}
    <div id="cart-page-data" data-auth="{{ Auth::check() ? 'true' : 'false' }}" data-csrf="{{ csrf_token() }}">
    </div>

    <div class="container mx-auto px-4 py-16">
        <h1 class="section-title fade-in">Keranjang Belanja</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div id="empty-cart-message" class="hidden text-center py-16 bg-white rounded-lg shadow-md">
                    <p class="text-xl text-gray-600 mb-6">Keranjang Anda masih kosong.</p>
                    <a href="{{ route('products.index') }}" class="btn-maroon">
                        Mulai Belanja Sekarang
                    </a>
                </div>

                <div id="cart-items-container" class="space-y-4">
                    {{-- Item keranjang akan dirender oleh cart-page.js di sini --}}
                </div>
            </div>

            <div class="lg:col-span-1">
                <div id="cart-summary-container" class="cart-summary hidden">
                    {{-- Ringkasan akan dirender oleh cart-page.js di sini --}}
                </div>
            </div>

        </div>
    </div>
@endsection
