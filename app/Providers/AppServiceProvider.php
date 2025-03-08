<?php

namespace App\Providers;

use App\Repositories\Contracts\Investment\InvestmentRepositoryInterface;
use App\Repositories\Contracts\TransactionCategoryRepositoryInterface;
use App\Repositories\Eloquent\TransactionCategoryRepository;

use App\Repositories\Contracts\Saving\SavingRepositoryInterface;
use App\Repositories\Contracts\Transaction\TransactionRepositoryInterface;
use App\Repositories\Eloquent\Investment\InvestmentRepository;
use App\Repositories\Eloquent\Saving\SavingRepository;
use App\Repositories\Eloquent\Transaction\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the TransactionRepositoryInterface to the TransactionRepository
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);

        // Bind the TransactionCategoryRepositoryInterface to the TransactionCategoryRepository
        $this->app->bind(TransactionCategoryRepositoryInterface::class, TransactionCategoryRepository::class);

        // Bind the SavingRepositoryInterface to the SavingRepository
        $this->app->singleton(SavingRepositoryInterface::class, SavingRepository::class);

        // Bind the InvestmentRepositoryInterface to the InvestmentRepository
        $this->app->singleton(InvestmentRepositoryInterface::class, InvestmentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
