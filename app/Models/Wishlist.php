<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(\App\Models\Product::class,'product_id','id');
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }
}
