<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantees extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
        'price_increase',
        'status',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
