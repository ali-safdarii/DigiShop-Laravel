<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image'
    ];

    /*protected $casts = ['image' => 'array'];*/

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
