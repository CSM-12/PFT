<?php

namespace App\Repositories\Eloquent\Dashboard\Charts;

use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Dashboard\Charts\SemesterTransactionChartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SemesterTransactionChartRepository implements SemesterTransactionChartRepositoryInterface
{
    public function index(string $period = 'this_month')
    {
        $userId = Auth::id();
        $startDate = Carbon::now()->subMonths(5)->startOfMonth(); // 6 months total
        $endDate = Carbon::now()->endOfMonth();

        // Get data from DB
        $transactions = Transaction::where('user_id', $userId)
            ->where('direction', 0)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("DATE_FORMAT(created_at, '%m') as month, SUM(amount) as total")
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
            'data' => $months->values()->toArray(),
        ];
    }
}
