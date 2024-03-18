<?php

namespace App\Models\Admin\Payment;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
      'user_id' ,
      'payment_amount' ,
      'payment_date' ,
      'payment_method' ,
      'status' ,
      'description' ,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
