<?php

namespace App\Models\Admin\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'parent_id',
        'user_id',
        'commentable_id',
        'commentable_type',
        'seen',
        'approved'
    ];


    public function commentable () {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
