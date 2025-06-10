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
            default        => Carbon::now()->startOfMonth(), // fallback
        };

        // Fetch categories with transaction sum
        $categories = TransactionCategory::select('id', 'title', 'icon')
            ->withSum(['transactions' => function ($query) use ($startDate) {
                $query->where('category_type', TransactionCategory::class)
                      ->where('user_id', Auth::id())
                      ->where('created_at', '>=', $startDate);
            }], 'amount')
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'icon' => $category->icon,
                    'total_amount' => $category->transactions_sum_amount ?? 0,
                ];
            })
            ->sortByDesc('total_amount')
            ->values();

        // Get top 3
        $topCategories = $categories->take(3);

        // Sum of "others"
        $othersSum = $categories->skip(3)->sum('total_amount');

        if ($categories->count() > 3) {
            $topCategories->push([
                'id' => null,
                'title' => 'Others',
                'icon' => null,
                'total_amount' => $othersSum,
            ]);
        }

        return $topCategories->values();
    }
}
