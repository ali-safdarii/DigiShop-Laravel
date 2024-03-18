<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'unit',
    ];


    public function category () {
        return $this->belongsTo(ProductCategory::class);
    }

    public function values () {
        return $this->hasMany(CategoryValue::class);
    }
}
