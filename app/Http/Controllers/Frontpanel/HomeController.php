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
        $banners = Banner::all();
        $products = Product::all();
        return view('frontpanel.home.index', compact('banners', 'products'));
    }

    public function showDetailProduct($a)
    {
        $product = Product::where('id', $a)
            ->first();
        return view('frontpanel.products.detail', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));

        $cartItem = CartItem::where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            CartItem::create([
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
                'price' => $product->price
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function buyNow(Request $request)
    {
        $this->addToCart($request);
        return redirect()->route('checkout');
    }

}
