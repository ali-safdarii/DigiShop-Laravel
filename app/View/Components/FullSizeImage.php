<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FullSizeImage extends Component
{
    public $imageUrl;
    public $id;
    public $alt;

    public function __construct($imageUrl,$id,$alt)
    {
        $this->imageUrl = $imageUrl;
        $this->id = $id;
        $this->alt = $alt;
    }

    public function render()
    {
        return view('components.custom-component.full-size-image');
    }
}
