<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

//    update cart if product available is less than product quantity in cart
// we learned about this from the tutorial https://www.youtube.com/watch?v=zGzBVBcEj84&list=PLe30vg_FG4OSdVn4zFpXNpBILtijJ2-x7&index=6&ab_channel=Bitfumes
     public function updateCartQuantity(){
        if (auth()) {
            if ($this->quantity > $this->Product->quantity_available) {
                $this->quantity = $this->Product->quantity_available;
                if ($this->Product->quantity_available < 0) {
                    $this->quantity = 0;
                }
                $this->save();
            }
        }
    }

    public function product(){
        return $this->belongsTo(\App\Models\Product::class,'product_id','id');
    }

    public function user(){
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }
}
