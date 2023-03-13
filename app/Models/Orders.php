<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'payment_id',
        'uid',
        'cart_total',
        'ordered_at',
        'pname',
        'category',
        'qty',
        'rent_period',
    ];
    public $timestamps = false;
}
