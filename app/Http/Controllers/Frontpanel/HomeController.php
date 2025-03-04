<?php

namespace App\Http\Controllers\Frontpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua banner
        $banners = Banner::all();

        // Mengambil semua produk
        $products = Product::all();

        // Mengirimkan data banners dan products ke view
        return view('frontpanel.home.index', compact('banners', 'products'));
    }
}
