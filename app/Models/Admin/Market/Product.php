<?php

namespace App\Models\Admin\Market;

use App\Models\Admin\Cart\CartItem;
use App\Models\Admin\Content\Comment;
use App\Models\Tag;
use Illuminate\Support\Carbon;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name',
        'model_name',
        'introduction',
        'slug',
        'image',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'status',
        'marketable',
        'tags',
        'sold_number',
        'frozen_number',
        'marketable_number',
        'brand_id',
        'category_id',
        'default_color_id',
        'published_at',
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



    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function defaultColor()
    {
        return $this->belongsTo(Color::class, 'default_color_id');
    }

    public function images()
    {
        return $this->hasMany(ProductGallery::class)->latest();
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function guarantees()
    {
        return $this->hasMany(Guarantees::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function activeDiscount()
    {
      //  $currentDate = Carbon::now();
        return  $this->amazingSales()
            //->where('end_date', '>=', $currentDate)
            ->where('status', '=', 1)
            ->first();

    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }


}
