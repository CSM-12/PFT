<?php

namespace App\Livewire\Dashboard\Charts;

use App\Repositories\Contracts\Dashboard\Charts\TotalSavingsRepositoryInterface;
use Livewire\Component;

class TotalSavings extends Component
{
    public $totalSavings;

    public function mount(TotalSavingsRepositoryInterface $repository)
    {
        $this->totalSavings = $repository->index();
    }

    public function render()
    {
        return view('livewire.dashboard.charts.total-savings', [
            'totalSavings' => $this->totalSavings
        ]);
    }
}
