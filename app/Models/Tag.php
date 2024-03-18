<?php

namespace App\Models;

use App\Models\Admin\Content\PostCategory;
use App\Models\Admin\Market\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function postCategories()
    {
        return $this->belongsToMany(PostCategory::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
}
