<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconSelector extends Component
{
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($icon = 'bx-category-alt')
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon-selector');
    }
}
