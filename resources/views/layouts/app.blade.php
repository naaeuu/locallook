<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --maroon: #800000;
            --maroon-dark: #550000;
            --nude: #f5e9e2;
            --black: #1a1a1a;
        }
        body { background-color: var(--nude); color: var(--black); font-family: 'Montserrat', sans-serif; }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://asset.kompas.com/crops/ZEjGPUpWPCY1VOlHr-b8TVu95NQ=/0x0:1000x667/1200x800/data/photo/2024/01/21/65abfedd4b4c7.jpg');
            background-size: cover; height: 90vh; display: flex; align-items: center; justify-content: center; color: white; text-align: center;
        }
        .hero-section h1 { font-family: 'Playfair Display', serif; font-size: 3rem; }
        .btn-maroon {
            background-color: var(--maroon); color: white; border: none; padding: 0.75rem 1.75rem; border-radius: 50px;
        }
        .btn-maroon:hover { background-color: var(--maroon-dark); }
        .section { padding: 5rem 0; }
        .section-title { font-family: 'Playfair Display', serif; color: var(--maroon); text-align: center; }
        .fade-in { opacity: 0; transform: translateY(30px); transition: opacity 0.6s, transform 0.6s; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
        .cart-badge {
            position: absolute; top: -5px; right: -10px; background: var(--maroon); color: white;
            border-radius: 50%; width: 20px; height: 20px; font-size: 0.75rem; display: flex; align-items: center; justify-content: center;
        }
    </style>
</head>
<body>
    @include('components.navbar')
    <main>@yield('content')</main>
    @include('components.footer')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
