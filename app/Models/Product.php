<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['pid', 'p_name', 'p_size', 'p_image', 'p_price', 'p_category', 'pincode', 'featured', 'stock'];

    public $timestamps = false;
    public $table = "products";
    protected $primaryKey = "pid";
}
