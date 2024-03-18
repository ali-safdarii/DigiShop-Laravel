<?php

namespace App\Models\Admin\Market;

use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes,Sluggable;

    protected $fillable = [
        'name',
        'persian_name',
        'description',
        'slug',
        'image',
        'status'
    ];

    protected $casts = ['image' => 'array'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
