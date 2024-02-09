<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAdmin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'username', 'user_email'];

    public $timestamps = false;
}
