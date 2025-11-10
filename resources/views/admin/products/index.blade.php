@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="font-heading text-3xl font-bold text-black">
            Daftar Produk
        </h1>

        {{-- Nanti ini akan mengarah ke route('admin.products.create') --}}
        <a href="{{ route('admin.products.create') }}" class="btn-maroon py-2 px-4 text-sm">
            <i class="fas fa-plus mr-2"></i>
            Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Tabel Produk --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 font-semibold">Nama Produk</th>
                    <th class="p-4 font-semibold">Harga</th>
                    <th class="p-4 font-semibold">Stok</th>
                    <th class="p-4 font-semibold">Kategori</th>
                    <th class="p-4 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b border-gray-100">
                        <td class="p-4 flex items-center gap-3">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                class="w-12 h-12 object-cover rounded">
                            <span class="font-medium">{{ $product->name }}</span>
                        </td>
                        <td class="p-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="p-4">{{ $product->stock }}</td>
                        <td class="p-4">{{ $product->categories }}</td>
                        <td class="p-4">
                            {{-- Nanti kita tambahkan tombol Edit & Hapus --}}
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Anda yakin ingin menghapus produk {{ $product->name }}? Tindakan ini tidak bisa dibatalkan.');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection
