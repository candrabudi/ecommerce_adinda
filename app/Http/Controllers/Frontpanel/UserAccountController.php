<?php

namespace App\Http\Controllers\Frontpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\CustomerAddress;
class UserAccountController extends Controller
{
    public function account()
    {
        return view('frontpanel.account.index');
    }

    public function orders()
    {
        return view('frontpanel.account.orders');
    }

    public function favorites()
    {
        return view('frontpanel.account.favorites');
    }

    public function addresses()
    {
        $provinces = Province::all();
        $addresses = CustomerAddress::where('user_id', auth()->user()->id)->get(); 
        return view('frontpanel.account.addresses', compact('provinces', 'addresses'));
    }
    
}
