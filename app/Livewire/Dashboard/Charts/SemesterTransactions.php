<?php

namespace App\Livewire\Dashboard\Charts;

use App\Repositories\Contracts\Dashboard\Charts\SemesterTransactionChartRepositoryInterface;
use Livewire\Component;

class SemesterTransactions extends Component
{
    public $Semester_transactions = [];

    public function mount(SemesterTransactionChartRepositoryInterface $repository)
    {
        $this->Semester_transactions['income'] = $repository->income();
        $this->Semester_transactions['expense'] = $repository->expense();
        $this->Semester_transactions['difference'] = $repository->difference();
    }

    public function render()
    {
        // dd(json_encode($this->Semester_transactions));
        return view('livewire.dashboard.charts.semester-transactions');
    }
}
