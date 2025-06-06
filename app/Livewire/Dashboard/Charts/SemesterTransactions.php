<?php

namespace App\Livewire\Dashboard\Charts;

use App\Repositories\Contracts\Dashboard\Charts\SemesterTransactionChartRepositoryInterface;
use Livewire\Component;

class SemesterTransactions extends Component
{
    public $Semester_transactions;
    public function mount(SemesterTransactionChartRepositoryInterface $repository)
    {
        $this->Semester_transactions = $repository->index();
    }
    public function render()
    {
        // dd(json_encode($this->Semester_transactions));
        return view('livewire.dashboard.charts.semester-transactions');
    }
}
