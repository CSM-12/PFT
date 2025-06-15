<?php

namespace App\Repositories\Eloquent\Dashboard\Charts;

use App\Models\Saving\Saving;
use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Dashboard\Charts\TotalSavingsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TotalSavingsRepository implements TotalSavingsRepositoryInterface
{
    public function index()
    {
        $userId = Auth::id();
        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Fetch all transactions for the last 6 months, sorted by date
        $transactions = Transaction::where('category_type', Saving::class)
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at')
            ->get();

        // Prepare months keys
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthKey = Carbon::now()->subMonths($i)->format('Y-m');
            $months[$monthKey] = 0;
        }

        // Calculate running total
        $runningTotal = 0;
        foreach ($months as $monthKey => $value) {
            // Get transactions for this month
            $monthTransactions = $transactions->filter(function ($t) use ($monthKey) {
                return Carbon::parse($t->created_at)->format('Y-m') === $monthKey;
            });

            // Net for this month
            $monthNet = $monthTransactions->sum(function ($t) {
                return $t->direction == 1 ? $t->amount : -$t->amount;
            });

            $runningTotal += $monthNet;
            $months[Carbon::createFromFormat('Y-m', $monthKey)->format('F Y')] = $runningTotal;
        }

        return [
            'total' => $runningTotal,
            'monthly' => $months
        ];
    }
}
