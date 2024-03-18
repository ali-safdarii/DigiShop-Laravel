<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color_code',
        'price_increase',
        'is_defualt',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_colors');
    }
}
