<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['pid', 'p_name', 'p_size', 'p_image', 'p_price', 'p_category'];

    public $timestamps = false;
}
