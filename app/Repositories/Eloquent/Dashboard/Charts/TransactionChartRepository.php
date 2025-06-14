<?php

namespace App\Repositories\Eloquent\Dashboard\Charts;

use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Dashboard\Charts\TransactionChartRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionChartRepository implements TransactionChartRepositoryInterface
{
    public function index()
    {
        return Transaction::with(['category:id,title,icon'])
            ->where('user_id', '=', Auth::id())
            ->orderByDesc('created_at')
            ->take(5)
            ->get();
    }
}
