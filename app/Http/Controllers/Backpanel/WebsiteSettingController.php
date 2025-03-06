<?php

namespace App\Http\Controllers\Backpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
class WebsiteSettingController extends Controller
{
    public function websiteSettings()
{
    // Ambil data pengaturan website dari database
    $settings = WebsiteSetting::first();
    return view('backpanel.website_settings.index', compact('settings'));
}

public function saveWebsiteSettings(Request $request)
{
    // Validasi input
    $request->validate([
        'web_name' => 'required|string|max:255',
        'web_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        'web_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:512',
        'web_description' => 'required|string',
        'web_meta_title' => 'required|string|max:255',
        'web_meta_keywords' => 'nullable|string',
        'web_meta_description' => 'nullable|string',
        'web_google_analytics' => 'nullable|string',
        'web_facebook_pixel' => 'nullable|string',
        'web_header_script' => 'nullable|string',
        'web_footer_script' => 'nullable|string',
        'web_og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        'web_status' => 'required|integer',
    ]);

    // Ambil pengaturan website yang ada atau buat baru jika tidak ada
    $settings = WebsiteSetting::firstOrNew();

    // Simpan logo jika ada dalam request
    if ($request->hasFile('web_logo')) {
        $webLogoPath = $request->file('web_logo')->store('website', 'public');
        $settings->web_logo = $webLogoPath;
    }

    // Simpan favicon jika ada dalam request
    if ($request->hasFile('web_favicon')) {
        $webFaviconPath = $request->file('web_favicon')->store('website', 'public');
        $settings->web_favicon = $webFaviconPath;
    }

    // Simpan og_image jika ada dalam request
    if ($request->hasFile('web_og_image')) {
        $webOgImagePath = $request->file('web_og_image')->store('website', 'public');
        $settings->web_og_image = $webOgImagePath;
    }

    // Update atau buat pengaturan baru dengan data yang lain
    $settings->fill([
        'web_name' => $request->input('web_name'),
        'web_description' => $request->input('web_description'),
        'web_meta_title' => $request->input('web_meta_title'),
        'web_meta_keywords' => $request->input('web_meta_keywords'),
        'web_meta_description' => $request->input('web_meta_description'),
        'web_google_analytics' => $request->input('web_google_analytics'),
        'web_facebook_pixel' => $request->input('web_facebook_pixel'),
        'web_header_script' => $request->input('web_header_script'),
        'web_footer_script' => $request->input('web_footer_script'),
        'web_status' => $request->input('web_status'),
    ]);

    // Simpan pengaturan website
    $settings->save();

    // Redirect dengan pesan sukses
    return redirect()->route('backpanel.website.settings')->with('success', 'Website settings updated successfully');
}

}
