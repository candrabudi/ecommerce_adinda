<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories', 'variants', 'images'])->get();
        $categories = Category::all();

        return view('backpanel.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backpanel.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array', // Validasi untuk kategori
            'categories.*' => 'exists:categories,id', // Memastikan kategori ada di tabel categories
        ]);

        $product = Product::create($request->only('name', 'short_description', 'long_description', 'status', 'stock', 'price', 'discount'));

        // Simpan gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        // Simpan kategori produk
        $product->categories()->attach($request->categories);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with('categories', 'images')->findOrFail($id);
        $categories = Category::all(); // Semua kategori untuk opsi select

        return view('backpanel.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'status' => 'required|boolean',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array', // Validasi kategori
            'categories.*' => 'exists:categories,id', // Memastikan kategori ada
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'short_description', 'long_description', 'status', 'stock', 'price', 'discount'));

        // Update Kategori
        $product->categories()->sync($request->categories); // Sinkronisasi kategori baru

        // Hapus Gambar Lama jika dipilih
        if ($request->has('delete_old_images')) {
            foreach ($request->delete_old_images as $image_id) {
                $image = ProductImage::findOrFail($image_id);
                if (\Storage::disk('public')->exists($image->image_path)) {
                    \Storage::disk('public')->delete($image->image_path);
                }
                $image->delete();
            }
        }

        // Upload Gambar Baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->categories()->detach();

        foreach ($product->images as $image) {
            \Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('backpanel.products.index')->with('success', 'Product deleted successfully!');
    }
}
