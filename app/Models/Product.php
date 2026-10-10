<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Fields that can be inserted or updated through mass assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'status',
    ];
}