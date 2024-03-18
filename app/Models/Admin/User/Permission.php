<?php

namespace App\Models\Admin\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;

    public function rloes() {
        return $this->belongsToMany(Role::class);
    }
}
