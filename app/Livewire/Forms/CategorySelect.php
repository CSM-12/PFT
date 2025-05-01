<?php

namespace App\Livewire\Forms;

use App\Models\Investment\Investment;
use App\Models\Saving\Saving;
use App\Models\TransactionCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategorySelect extends Component
{
    // in Forms\CategorySelect.php
    public $type;
    public $category_id;
    public $direction;
    public $categories = [];

    public function mount($type = 'transactioncategory', $category_id = null, $direction = null)
    {
        // set type as transaction if its transactioncategory
        if(strtolower(class_basename($type)) === 'transactioncategory'){
            $this->type = 'transaction';
            $type = 'transaction';
        }

        $this->type = strtolower(class_basename($type)) ?? 'transaction';
        $this->category_id = $category_id;
        $this->direction = $direction ?? '1'; // default to income

        $this->updatedType();
    }


    public function updatedType()
    {
        $type = $this->type;
        
        $user_id = Auth::id();

        if ($type == 'saving') {
            $this->categories = Saving::where('user_id', $user_id)
                ->select('id', 'title')
                ->get();
        } elseif ($type == 'investment') {
            $this->categories = Investment::where('user_id', $user_id)
                ->select('id', 'title')
                ->get();
        } else {
            $this->categories = TransactionCategory::where('user_id', $user_id)
                ->select('id', 'title')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.forms.category-select');
    }
}
