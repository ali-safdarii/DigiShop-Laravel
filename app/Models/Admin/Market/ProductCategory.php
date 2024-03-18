<?php

namespace App\Models\Admin\Market;

use App\Models\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory,Sluggable,SoftDeletes;


    protected $fillable = [
        'id',
        'name',
        'description',
        'slug',
        'image',
        'tags',
        'status',
        'show_in_menu'
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

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }


    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }



    public function addChild(ProductCategory $child)
    {
        $this->children()->save($child);
    }

    public function getFullCategoryNameAttribute()
    {
        $names = [$this->name];
        $parent = $this->parent;
        while ($parent) {
            array_unshift($names, $parent->name);
            $parent = $parent->parent;
        }
        return implode('/', $names);
    }


    public function getLastTwoParentCategories()
{
    $parents = [];
    $parent = $this->parent;

    while ($parent) {
        array_unshift($parents, $parent);
        $parent = $parent->parent;
    }

    // If there are fewer than two parents, return all of them.
    if (count($parents) <= 1) {
        return $parents;
    }

    // Get the last two parent categories.
    return array_slice($parents, -2);
}

}
