@extends('layouts.main')

@section('title', 'Alamat Pengiriman')

@section('content')
    {{--
  UPDATE:
  1. Menambahkan data-pay-route
  2. Menambahkan data-home-route
--}}
    <div id="cart-page-data" data-auth="{{ Auth::check() ? 'true' : 'false' }}" data-csrf="{{ csrf_token() }}"
        data-pay-route="{{ route('checkout.pay') }}" data-home-route="{{ route('home') }}"></div>

    <div class="container mx-auto px-4 py-16">
        <h1 class="section-title fade-in">Alamat Pengiriman</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="font-heading text-2xl font-bold text-black mb-6">Pilih Alamat Tersimpan</h2>

                    {{-- Notifikasi Error/Sukses (jika ada) --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- Notifikasi Error dari JavaScript --}}
                    <div id="js-error-alert"
                        class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert"></div>


                    {{-- Form Utama: Proses Checkout --}}
                    {{-- Form ini akan dibaca oleh checkout-address.js --}}
                    <form id="checkout-form">
                        @csrf
                        <input type="hidden" name="cart" id="checkout-cart-data">

                        <div class="space-y-4">
                            @forelse ($addresses as $index => $address)
                                <label
                                    class="block border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-maroon">
                                    <div class="flex items-center">
                                        <input type="radio" name="address_id" value="{{ $address->id }}"
                                            class="text-maroon focus:ring-maroon" {{ $index == 0 ? 'checked' : '' }}>
                                        <div class="ml-4">
                                            <div class="font-semibold text-black">{{ $address->label }}
                                                ({{ $address->recipient_name }})</div>
                                            <div class="text-gray-600 text-sm">{{ $address->phone_number }}</div>
                                            <div class="text-gray-600 text-sm">{{ $address->address_line_1 }}</div>
                                            <div class="text-gray-600 text-sm">{{ $address->city }},
                                                {{ $address->postal_code }}</div>
                                        </div>
                                    </div>
                                </label>
                            @empty
                                <p class="text-gray-500">Anda belum memiliki alamat tersimpan. Silakan tambahkan di formulir
                                    samping.</p>
                            @endforelse
                        </div>

                        <div class="mt-8">
                            <button type="button" id="pay-button" class="btn-maroon py-3 text-base"
                                {{ $addresses->isEmpty() ? 'disabled' : '' }}>
                                Bayar Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-8 sticky top-28">
                    <h2 class="font-heading text-2xl font-bold text-black mb-6">Tambah Alamat Baru</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('checkout.address.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="label" class="block text-sm font-medium text-gray-700">Label Alamat</label>
                            <input type="text" name="label" id="label" required class="search-bar-input"
                                placeholder="Contoh: Rumah, Kantor">
                        </div>
                        <div>
                            <label for="recipient_name" class="block text-sm font-medium text-gray-700">Nama
                                Penerima</label>
                            <input type="text" name="recipient_name" id="recipient_name" required
                                class="search-bar-input">
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                            <input type="text" name="phone_number" id="phone_number" required class="search-bar-input">
                        </div>
                        <div>
                            <label for="address_line_1" class="block text-sm font-medium text-gray-700">Alamat
                                Lengkap</label>
                            <textarea name="address_line_1" id="address_line_1" rows="3" required class="search-bar-input"
                                placeholder="Jalan, No. Rumah, RT/RW, Kelurahan..."></textarea>
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
                            <input type="text" name="city" id="city" required class="search-bar-input">
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input type="text" name="postal_code" id="postal_code" required class="search-bar-input">
                        </div>
                        <button type="submit" class="btn-outline-maroon w-full py-2 text-sm">
                            Simpan Alamat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
