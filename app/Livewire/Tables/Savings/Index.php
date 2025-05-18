<?php

namespace App\Livewire\Tables\Savings;

use App\Repositories\Eloquent\Saving\SavingRepository;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public $limit = 10;
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
        $savings = $query->paginate($this->limit)->withQueryString();

        return view('livewire.tables.savings.index', [
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

    // Updating limit
    public function updatingLimit()
    {
        $this->resetPage();
    }

    // updating search
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
