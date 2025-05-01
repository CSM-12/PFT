<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconSelector extends Component
{
    public $name;
    public $selected;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($name = 'bx-wallet', $selected = null, $label = 'Select Icon')
    {
        $this->name = $name;
        $this->selected = $selected;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon-selector');
    }
}
