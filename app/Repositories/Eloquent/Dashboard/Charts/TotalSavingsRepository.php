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
        $year = Carbon::now()->year;

        // Net total for the year
        $total = Transaction::where('category_type', Saving::class)
            ->where('user_id', $userId)
            ->whereYear('created_at', $year)
            ->selectRaw('SUM(CASE WHEN direction = 1 THEN amount ELSE -amount END) as balance')
            ->value('balance');

        // Last 6 months (semester)
        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $monthly = Transaction::where('category_type', Saving::class)
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(CASE WHEN direction = 1 THEN amount ELSE -amount END) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Ensure all last 6 months are present, fill missing with 0
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $monthKey = Carbon::now()->subMonths($i)->format('Y-m');
            $months->put($monthKey, (float) ($monthly[$monthKey] ?? 0));
        }

        return [
            'total' => $total,
            'monthly' => $months
        ];
    }
}
