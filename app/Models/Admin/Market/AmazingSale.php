<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'amazing_sales';

    protected $fillable = [
        'id',
        'product_id',
        'status',
        'start_date',
        'end_date',
        'percentage'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
