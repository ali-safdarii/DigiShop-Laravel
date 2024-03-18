<?php

namespace App\Models\Admin\Content;

use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;


    protected $fillable = [
        'title',
        'body',
        'slug',
        'status',
        'summery',
        'image',
        'is_comment',
        'tags',
        'published_at',
        'user_id',
        'category_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = ['image' => 'array'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public  function postCategory(){
        return $this->belongsTo(PostCategory::class,'category_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class , 'commentable');
    }
}
