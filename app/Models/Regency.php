<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class, 'regency_id');
    }
}
