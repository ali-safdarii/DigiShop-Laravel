<?php

namespace App\Models\Admin\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'position',
        'url',
        'status',
        'is_used_mobile'
    ];

    protected $casts = ['image' => 'array'];

    public static $positions = [
        1 => 'SlideShow',
        2 => 'Left-Of-SlideShow',
        3 => 'Right-Of-SlideShow',
        4 => 'Midlle-Center',
        5 => 'Midlle-Center-Left',
        6 => 'Midlle-Center-Right',
        7 => 'Bottom-Center',
        8 => 'Bottom-Center-Left',
        9 => 'Bottom-Center-Right',
    ];
}
