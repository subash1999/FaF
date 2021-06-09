<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'current_price' => 'decimal:2',
    ];

    public function updateCartQuantityOfProduct(){
        if (auth()) {
            $cart = \App\Models\Cart::where('product_id', $this->id)->where('user_id', auth()->user()->id)->first();
            if (isset($cart)) {
                if ($cart->quantity > $this->quantity_available) {
                    $cart->quantity = $this->quantity_available;
                    if ($this->quantity_available < 0) {
                        $cart->quantity = 0;
                    }
                    $cart->save();
                }
            }
        }
    }

    public function getFinalPriceAttribute()
    {
        $dis = !isset($this->discount) ? 0 : $this->discount;
        return $this->price - $this->discount;
    }

    public function isProductInCart()
    {
        if (auth()) {
            return \App\Models\Cart::where('product_id', $this->id)->where('user_id', auth()->user()->id)->count() > 0;
        }
        return false;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo(\App\Models\ProductCategory::class, 'product_category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages()
    {
        return $this->hasMany(\App\Models\ProductImage::class, 'product_id', 'id');
    }

    public function cart(){
        return $this->hasOne(\App\Models\Product::class,'product_id','id');
    }
}
