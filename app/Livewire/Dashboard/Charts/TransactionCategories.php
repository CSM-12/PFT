<?php

namespace App\Livewire\Dashboard\Charts;

use App\Repositories\Contracts\Dashboard\Charts\TransactionCategoriesChartRepositoryInterface;
use Livewire\Component;

class TransactionCategories extends Component
{
    public $transactionCategoriesChartData = [];
    public $period = 'this_year';

    public function setPeriod($period)
    {
        $this->period = $period;
        // Reload transactions based on the new period
        $this->transactionCategoriesChartData = app(\App\Repositories\Contracts\Dashboard\Charts\TransactionCategoriesChartRepositoryInterface::class)->index($period);
    }

    public function mount(TransactionCategoriesChartRepositoryInterface $repository)
    {
        $this->transactionCategoriesChartData = $repository->index($this->period);
    }

    public function render()
    {
        return view('livewire.dashboard.charts.transaction-categories', [
            'transactionCategoriesChartData' => $this->transactionCategoriesChartData
        ]);
    }
}
