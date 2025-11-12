@extends('layouts.main')

@section('title', 'Tentang Lokalook')

@section('content')

    <section class="section bg-gray-100 text-center fade-in">
        <div class="container mx-auto px-4">
            <h1 class="section-title">Tentang Lokalook</h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                Selamat datang di Lokalook! Kami adalah platform e-commerce yang berdedikasi untuk memajukan brand fashion
                lokal Indonesia.
            </p>
        </div>
    </section>

    <section class="section bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Interior toko fashion lokal"
                        class="rounded-lg shadow-xl w-full h-auto object-cover aspect-video">
                </div>
                <div class="fade-in" style="--delay: 0.1s;">
                    <h2 class="font-heading text-3xl font-bold text-maroon mb-6">Visi & Misi Kami</h2>
                    <p class="text-gray-700 mb-4">
                        <strong>Visi Kami:</strong> Menjadi etalase utama bagi karya-karya terbaik desainer dan pengrajin
                        lokal, membawa keunikan fashion Nusantara ke panggung global.
                    </p>
                    <p class="text-gray-700">
                        <strong>Misi Kami:</strong> Memberdayakan UMKM fashion melalui platform yang mudah diakses, adil,
                        dan transparan. Kami percaya bahwa setiap brand lokal berhak mendapatkan kesempatan untuk bersinar.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="why-us" class="section bg-gray-100" aria-labelledby="why-us-title">
        <div class="container mx-auto px-4">
            <h2 id="why-us-title" class="section-title fade-in">Kenapa Memilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="fade-in" style="--delay: 0.1s;">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-gem"></i></div>
                        <h3 class="feature-title">Kualitas Terbaik</h3>
                        <p>Kami menggunakan bahan-bahan premium dan dikerjakan oleh pengrajin berpengalaman.</p>
                    </div>
                </div>

                <div class="fade-in" style="--delay: 0.2s;">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-palette"></i></div>
                        <h3 class="feature-title">Desain Eksklusif</h3>
                        <p>Setiap koleksi dirancang secara unik dengan sentuhan budaya nusantara.</p>
                    </div>
                </div>

                <div class="fade-in" style="--delay: 0.3s;">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                        <h3 class="feature-title">Pelayanan Cepat & Responsif</h3>
                        <p>Admin kami siap merespon pesanan Anda melalui WhatsApp dengan cepat.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
