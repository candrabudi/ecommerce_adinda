<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;

    // Allow mass assignment for the following fields
    protected $fillable = [
        'payment_method_id',
        'account_name',
        'account_number',
        'account_status',
    ];

    // Define relationship with PaymentMethod
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
