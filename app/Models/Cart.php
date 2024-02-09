<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['pid', 'uid', 'pname', 'price', 'image', 'size', 'category', 'rent_period'];

    public $timestamps = false;
    protected $table = 'cart';
}
