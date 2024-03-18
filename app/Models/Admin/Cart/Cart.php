<?php

namespace App\Models\Admin\Cart;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function calculateTotal()
    {
        $totalFinalPrice = 0;

        foreach ($this->cartItems as $cartItem) {
            $finalPrice = $cartItem->final_price;

            $totalFinalPrice += $finalPrice;
        }
        return $totalFinalPrice;
    }
}
