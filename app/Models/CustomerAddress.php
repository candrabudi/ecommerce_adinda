<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'address_name',
        'postal_code',
        'phone_number',
        'address_detail',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

    // Relasi ke tabel Customer (pemilik alamat)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi ke tabel Province
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Relasi ke tabel Regency
    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id');
    }

    // Relasi ke tabel District
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    // Relasi ke tabel Village
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
