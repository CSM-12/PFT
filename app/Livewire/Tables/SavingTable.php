<?php

namespace App\Livewire\Tables;

use App\Models\Saving\Saving;
use App\Repositories\Eloquent\Saving\SavingRepository;
use Livewire\Component;
use Livewire\WithPagination;

class SavingTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortColumn = 'id';
    public $sortDirection = 'asc';

    protected $repository;

    // Inject savings repository
    public function boot(SavingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function render()
    {
        $query = $this->repository->all($this->search, $this->sortColumn, $this->sortDirection);
        $savings = $query->paginate(1);

        return view('livewire.tables.saving-table', [
            'savings' => $savings
        ]);
    }

    // Sorting function
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    // Searching function
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
