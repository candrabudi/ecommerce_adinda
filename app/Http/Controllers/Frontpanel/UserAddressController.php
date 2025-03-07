<?php

namespace App\Http\Controllers\Frontpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\CustomerAddress;
class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'address_name' => 'required',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'address_detail' => 'required',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Buat instance baru dari CustomerAddress
            $customerAddress = new CustomerAddress();
            $customerAddress->user_id = auth()->user()->id; // contoh mengisi customer_id dari user yang sedang login
            $customerAddress->address_name = $request->address_name;
            $customerAddress->postal_code = $request->zip_code;
            $customerAddress->phone_number = $request->phone_number;
            $customerAddress->address_detail = $request->address_detail;
            $customerAddress->province_id = $request->province_id;
            $customerAddress->regency_id = $request->regency_id;
            $customerAddress->district_id = $request->district_id;
            $customerAddress->village_id = $request->village_id;
            
            // Simpan data
            $customerAddress->save();

            // Commit transaksi jika semua berjalan lancar
            DB::commit();
            
            return redirect()->route('frontpanel.account.addresses')->with('success', 'Alamat berhasil ditambahkan');
        
        } catch (Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            return response()->json($e->getMessage());

            // Kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan alamat: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'address_name' => 'required',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'address_detail' => 'required',
            'province_id' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Cari alamat customer berdasarkan ID
            $customerAddress = CustomerAddress::findOrFail($id);
            
            // Perbarui data alamat
            $customerAddress->address_name = $request->address_name;
            $customerAddress->postal_code = $request->zip_code;
            $customerAddress->phone_number = $request->phone_number;
            $customerAddress->address_detail = $request->address_detail;
            $customerAddress->province_id = $request->province_id;
            $customerAddress->regency_id = $request->regency_id;
            $customerAddress->district_id = $request->district_id;
            $customerAddress->village_id = $request->village_id;
            
            // Simpan perubahan
            $customerAddress->save();

            // Commit transaksi jika semua berjalan lancar
            DB::commit();
            
            return redirect()->route('frontpanel.account.addresses')->with('success', 'Alamat berhasil diperbarui');
        
        } catch (Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui alamat: ' . $e->getMessage());
        }
    }


    public function getRegencies($province_id)
    {
        $regencies = Regency::where('province_id', $province_id)->get();
        return response()->json($regencies);
    }

    public function getDistricts($regency_id)
    {
        $districts = District::where('regency_id', $regency_id)->get();
        return response()->json($districts);
    }

    public function getVillages($district_id)
    {
        $villages = Village::where('district_id', $district_id)->get();
        return response()->json($villages);
    }

    public function destroy($id)
    {
        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Cari alamat customer berdasarkan ID
            $customerAddress = CustomerAddress::findOrFail($id);
            
            // Hapus alamat
            $customerAddress->delete();

            // Commit transaksi jika penghapusan berhasil
            DB::commit();

            return redirect()->route('frontpanel.account.addresses')->with('success', 'Alamat berhasil dihapus');
        
        } catch (Exception $e) {
            // Rollback transaksi jika ada error
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus alamat: ' . $e->getMessage());
        }
    }

}
