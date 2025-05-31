<?php

namespace App\Livewire\Dashboard\Charts;

use App\Repositories\Contracts\Dashboard\Charts\TransactionChartRepositoryInterface;
use Livewire\Component;

class Transactions extends Component
{
    public $transactions = [];
    public $period = 'this_month';

    public function setPeriod($period)
    {
        $this->period = $period;
        // Reload transactions based on the new period
        $this->transactions = app(\App\Repositories\Contracts\Dashboard\Charts\TransactionChartRepositoryInterface::class)->index($period);
    }

    public function mount(TransactionChartRepositoryInterface $repository)
    {
        $this->transactions = $repository->index($this->period);
    }

    public function render()
    {
        return view('livewire.dashboard.charts.transactions');
    }
}
