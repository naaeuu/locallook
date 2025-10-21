<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data dummy — tidak butuh database
        $featuredProducts = [
            (object)[
                'id' => 1,
                'name' => 'Baju Batik Modern',
                'slug' => 'baju-batik-modern',
                'price' => 150000,
                'image_url' => 'https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            ],
            (object)[
                'id' => 2,
                'name' => 'Kemeja Linen Pria',
                'slug' => 'kemeja-linen-pria',
                'price' => 250000,
                'image_url' => 'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            ],
            (object)[
                'id' => 3,
                'name' => 'Kebaya Kontemporer',
                'slug' => 'kebaya-kontemporer',
                'price' => 320000,
                'image_url' => 'https://images.unsplash.com/photo-1601346081441-2471b89e1c29?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            ],
            (object)[
                'id' => 4,
                'name' => 'Celana Chino Premium',
                'slug' => 'celana-chino-premium',
                'price' => 180000,
                'image_url' => 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
            ],
        ];

        return view('index', compact('featuredProducts'));
    }
}
