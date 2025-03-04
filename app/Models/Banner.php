<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    // Define which fields can be mass-assigned
    protected $fillable = [
        'name',
        'description',
        'image_path',
    ];
}
