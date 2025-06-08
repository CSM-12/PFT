<?php

namespace App\Repositories\Eloquent\Dashboard\Charts;

use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Dashboard\Charts\SemesterTransactionChartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SemesterTransactionChartRepository implements SemesterTransactionChartRepositoryInterface
{
    public $userId;
    public $startDate;
    public $endDate;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->startDate = Carbon::now()->subMonths(5)->startOfMonth(); // 6 months total
        $this->endDate = Carbon::now()->endOfMonth();
    }

    public function income()
    {
        // Get data from DB
        $transactions = Transaction::where('user_id', $this->userId)
            ->where('direction', 1)
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw("DATE_FORMAT(created_at, '%m') as month, SUM(ABS(amount)) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month'); // e.g. ['05' => 11455, '06' => 400]

        // Ensure all last 6 months are present, fill missing with 0
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $monthKey = Carbon::now()->subMonths($i)->format('m');
            $months->put($monthKey, (float) ($transactions[$monthKey] ?? 0));
        }

        return [
            'labels' => $months->keys()
                ->map(fn($m) => Carbon::createFromFormat('m', $m)->format('M'))
                ->toArray(),
            'data' => $months->values()->toArray()
        ];
    }

    public function expense()
    {
        // Get data from DB
        $transactions = Transaction::where('user_id', $this->userId)
            ->where('direction', 0)
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->selectRaw("DATE_FORMAT(created_at, '%m') as month, SUM(ABS(amount)) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month'); // e.g. ['05' => 11455, '06' => 400]

        // Ensure all last 6 months are present, fill missing with 0
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $monthKey = Carbon::now()->subMonths($i)->format('m');
            $months->put($monthKey, (float) ($transactions[$monthKey] ?? 0));
        }

        return [
            'labels' => $months->keys()
                ->map(fn($m) => Carbon::createFromFormat('m', $m)->format('M'))
                ->toArray(),
            'data' => $months->values()->toArray()
        ];
    }

    public function difference()
    {
        // This quarter
        $thisQuarterStart = Carbon::now()->startOfQuarter();
        $thisQuarterEnd = Carbon::now()->endOfQuarter();

        // Last quarter
        $lastQuarterStart = Carbon::now()->subQuarter()->startOfQuarter();
        $lastQuarterEnd = Carbon::now()->subQuarter()->endOfQuarter();

        // Sum income for this quarter
        $thisQuarterIncome = Transaction::where('user_id', $this->userId)
            ->where('direction', 1)
            ->whereBetween('created_at', [$thisQuarterStart, $thisQuarterEnd])
            ->sum('amount');

        // Sum income for last quarter
        $lastQuarterIncome = Transaction::where('user_id', $this->userId)
            ->where('direction', 1)
            ->whereBetween('created_at', [$lastQuarterStart, $lastQuarterEnd])
            ->sum('amount');

        // Sum expense for this quarter
        $thisQuarterExpense = Transaction::where('user_id', $this->userId)
            ->where('direction', 0)
            ->whereBetween('created_at', [$thisQuarterStart, $thisQuarterEnd])
            ->sum('amount');

        // Sum expense for last quarter
        $lastQuarterExpense = Transaction::where('user_id', $this->userId)
            ->where('direction', 0)
            ->whereBetween('created_at', [$lastQuarterStart, $lastQuarterEnd])
            ->sum('amount');

        // Return both differences
        return [
            'income' => $thisQuarterIncome - $lastQuarterIncome,
            'expense' => $thisQuarterExpense - $lastQuarterExpense,
        ];
    }
}
