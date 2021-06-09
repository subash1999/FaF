<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('\App\Models\User','user_id','id');
    }

    public function orders(){
        return $this->hasMany('\App\Models\Order','bill_id','id');
    }

    /**
     * @return int
     */
    public function getFinalTotalPriceAttribute(){
        $grand_total_price = 0;
        foreach($this->Orders as $order){
            $grand_total_price += $order->quantity * $order->final_price;
        }
        return $grand_total_price;
    }

    /**
     * @return int
     */
    public function getTotalDiscountAttribute(){
        $total_discount = 0;
        foreach($this->Orders as $order){
            $total_discount += $order->quantity * $order->discount;
        }
        return $total_discount;
    }

    public function getTotalPriceAttribute(){
        $total_price = 0;
        foreach($this->Orders as $order){
            $total_price += $order->quantity * $order->price;
        }
        return $total_price;
    }

}

