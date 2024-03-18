<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'discount_code',
        'start_date',
        'end_date',
        'discount_type',
        'discount_value',
        'minimum_order_amount',
        'maximum_uses',
        'usage_count',
        'is_active',
        'is_public',
        'user_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
