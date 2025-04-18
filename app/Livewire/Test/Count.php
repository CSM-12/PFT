<?php

namespace App\Livewire\Test;

use Livewire\Component;

class Count extends Component
{
    public $count = 0;
    public $action = '';
    public $negation = false;

    public function updated($propertyName)
    {
        if ($propertyName === 'action') {
            if ($this->action === 'add') {
                $this->addCount();
            } elseif ($this->action === 'sub') {
                $this->subCount();
            }
        }
    }

    public function addCount()
    {
        $this->count++;
    }

    public function subCount()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.test.count');
    }
}