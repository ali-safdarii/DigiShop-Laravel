<?php

namespace App\View\Components\CustomComponent;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    //public $id;
    public $message;
    public $route;
    /**
     * Create a new component instance.
     */
    public function __construct($message,$route)
    {
        //$this->id = $id;
        $this->message = $message;
        $this->route = $route;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-component.delete-modal');
    }
}
