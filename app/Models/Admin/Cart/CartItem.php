<?php

namespace App\Models\Admin\Cart;

use App\Models\Admin\Market\Color;
use App\Models\Admin\Market\Guarantees;
use App\Models\Admin\Market\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'guarantee_id',
        'qty',
        'final_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    public function guarantee()
    {
        return $this->belongsTo(Guarantees::class);
    }


    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    // Define relationships
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
