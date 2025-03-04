<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('backpanel.banners.index', compact('banners'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required',
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Banner added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $banner->update([
                'image_path' => $imagePath,
            ]);
        }

        $banner->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Banner updated successfully!');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->back()->with('success', 'Banner deleted successfully!');
    }
}
