<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingService;

class ShippingServiceController extends Controller
{
    public function index()
    {
        $services = ShippingService::all();
        return view('backpanel.shipping_services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['name', 'status']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shipping_services', 'public');
        }

        ShippingService::create($data);

        return redirect()->back()->with('success', 'Shipping service added successfully');
    }

    public function update(Request $request, $id)
    {
        $service = ShippingService::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['name', 'status']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shipping_services', 'public');
        }

        $service->update($data);

        return redirect()->back()->with('success', 'Shipping service updated successfully');
    }

    public function destroy($id)
    {
        $service = ShippingService::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'Shipping service deleted successfully');
    }
}
