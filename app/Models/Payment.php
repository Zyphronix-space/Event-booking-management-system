<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';
    public $timestamps = false;

    protected $fillable = [
        'payment_method',
        'payment_date',
        'amount',
        'payment_status',
    ];

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class, 'payment_id', 'payment_id');
    }
}
