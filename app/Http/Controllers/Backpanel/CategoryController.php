<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backpanel.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $store = new Category();
        $store->parent_id = $request->parent_id ?? null;
        $store->name = $request->name;
        $store->slug = Str::slug($request->name);
        $store->description = $request->description;
        $store->status = $request->status;
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $originalExtension = $photo->getClientOriginalExtension();
            $newFileName = time() . '.' . $originalExtension;
            
            $photoPath = $photo->storeAs('notulensi_images', $newFileName, 'public');
        }
        $store->image = $photoPath;
        $store->save();

        return redirect()->route('backpanel.categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $id,
            'image' => 'nullable|image',
            'status' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->description = $request->description;

        // Update image jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('backpanel.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('backpanel.categories.index')->with('success', 'Category deleted successfully.');
    }
}
