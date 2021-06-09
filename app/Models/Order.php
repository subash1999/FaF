<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'current_price' => 'decimal:2',
    ];

    public function getFinalPriceAttribute()
    {
        $dis = !isset($this->discount) ? 0 : $this->discount;
        return $this->price - $this->discount;
    }

    public function product(){
        return $this->belongsTo(\App\Models\Product::class,'product_id','id');
    }

    public function shipping(){
        return $this->belongsTo(\App\Models\Shipping::class,'shipping_id','id');
    }

    public function bill(){
        return $this->belongsTo(\App\Models\Bill::class,'bill_id','id');
    }


    public function user(){
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }
}
