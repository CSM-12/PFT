<?php

namespace App\Repositories\Eloquent\Dashboard\Charts;

use App\Models\TransactionCategory;
use App\Repositories\Contracts\Dashboard\Charts\TransactionCategoriesChartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TransactionCategoriesChartRepository implements TransactionCategoriesChartRepositoryInterface
{
    public function index(string $period = 'this_month')
    {
        $startDate = match ($period) {
            'today'        => Carbon::today(),
            'this_week'    => Carbon::now()->startOfWeek(),
            'this_month'   => Carbon::now()->startOfMonth(),
            'this_quarter' => Carbon::now()->startOfQuarter(),
            'this_year'    => Carbon::now()->startOfYear(),
            default        => Carbon::now()->startOfMonth(),
        };

        $endDate = Carbon::now()->endOfDay();
        $userId = Auth::id();

        // Fetch all categories with their amounts
        $categories = TransactionCategory::select('id', 'title', 'icon')
            ->withSum(['transactions as total_amount' => function ($query) use ($userId, $startDate, $endDate) {
                $query->where('user_id', $userId)
                    ->whereBetween('created_at', [$startDate, $endDate]);
            }], 'amount')
            ->get()
            ->filter(fn($c) => $c->total_amount > 0)
            ->sortByDesc('total_amount')
            ->values();

        $totalAmount = $categories->sum('total_amount');
        $totalCategories = $categories->count();

        // Extract top 3
        $top3 = $categories->take(3);
        $others = $categories->slice(3);

        // Calculate 'Others' total
        $othersTotal = $others->sum('total_amount');

        // Build formatted response
        $formatted = $top3->map(function ($category) use ($totalAmount) {
            return [
                'id'           => $category->id,
                'title'        => $category->title,
                'icon'         => $category->icon,
                'total_amount' => number_format((float) $category->total_amount, 2, '.', ''),
                'percentage'   => $totalAmount > 0
                    ? round(($category->total_amount / $totalAmount) * 100, 2)
                    : 0,
            ];
        });

        // Add 'Others' if there are more than 3
        if ($othersTotal > 0) {
            $formatted->push([
                'id'           => null,
                'title'        => 'Others',
                'icon'         => null,
                'total_amount' => number_format((float) $othersTotal, 2, '.', ''),
                'percentage'   => $totalAmount > 0
                    ? round(($othersTotal / $totalAmount) * 100, 2)
                    : 0,
            ]);
        }

        return [
            'total_categories' => $totalCategories,
            'total_amount'     => number_format((float) $totalAmount, 2, '.', ''),
            'data'             => $formatted->values(),
        ];
    }
}
