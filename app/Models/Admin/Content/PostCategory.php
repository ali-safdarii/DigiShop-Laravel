<?php

namespace App\Models\Admin\Content;

use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory,SoftDeletes, Sluggable;


    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'tags',
        'status',
        'parent_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $casts = ['image' => 'array'];





    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


}
