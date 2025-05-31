<?php

namespace App\Repositories\Eloquent\Dashboard\Charts;

use App\Models\TransactionCategory;
use App\Repositories\Contracts\Dashboard\Charts\TransactionChartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TransactionChartRepository implements TransactionChartRepositoryInterface
{
    public function index(string $period = 'this_month')
    {
        $startDate = match ($period) {
            'today'      => Carbon::today(),
            'this_week'  => Carbon::now()->startOfWeek(),
            'this_month' => Carbon::now()->startOfMonth(),
            'this_quarter' => Carbon::now()->startOfQuarter(),
            'this_year'  => Carbon::now()->startOfYear(),
            default      => Carbon::now()->startOfMonth(), // fallback
        };

        return TransactionCategory::select('id', 'title', 'icon')
            ->withSum(['transactions' => function ($query) use ($startDate) {
                $query->where('category_type', TransactionCategory::class)
                      ->where('user_id', Auth::id())
                      ->where('created_at', '>=', $startDate);
            }], 'amount')
            ->get()
            ->map(function ($category) {
                $category->total_amount = $category->transactions_sum_amount ?? 0;
                unset($category->transactions_sum_amount);
                return $category;
            })
            ->sortByDesc('total_amount')
            ->take(6)
            ->values();
    }
}
