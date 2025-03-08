<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Investment\InvestmentController;
use App\Http\Controllers\Saving\SavingController;
use App\Http\Controllers\Transaction\Category\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthorizeRole;


// Authentication

// Login
Route::get('/login', function () {
    return view('pages.authentication.login'); // Make sure you have a login view
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Register
Route::get('/register', function () {
    return view('pages.authentication.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Authorizing user
Route::middleware(['auth', AuthorizeRole::class . ':user'])->group(function () {

    // dashboard
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // transactions
    Route::get('/transactions', function () {
        return view('pages.transactions.index');
    })->name('transactions');

    // ----------------- Transactions Routes Start -----------------

    // Transaction categories resource nested under transactions
    Route::prefix('transactions')->name('transactions.')->group(function () {

        // ----------------- Transaction Category Routes Start -----------------
        // Trash Category
        Route::patch('categories/{category}/trash', [TransactionCategoryController::class, 'trash'])->name('categories.trash');

        // Trashed Categories
        Route::get('categories/trashed', [TransactionCategoryController::class, 'trashed'])->name('categories.trashed');

        // Restore Trashed Category
        Route::patch('categories/{category}/restore', [TransactionCategoryController::class, 'restore'])->name('categories.restore');

        // Categories
        Route::resource('categories', TransactionCategoryController::class);
    });


    // Transactions
    Route::resource('transactions', TransactionController::class);


    // ----------------- Savings Routes Start -----------------
    // Trash Savings
    Route::patch('savings/{saving}/trash', [SavingController::class, 'trash'])->name('savings.trash');

    // Trashed Savings
    Route::get('savings/trashed', [SavingController::class, 'trashed'])->name('savings.trashed');

    // Restore Trashed Savings
    Route::patch('savings/{saving}/restore', [SavingController::class, 'restore'])->name('savings.restore');

    // Savings
    Route::resource('savings', SavingController::class);


    // ----------------- Investments Routes Start -----------------
    // Trash Investments
    Route::patch('investments/{investment}/trash', [InvestmentController::class, 'trash'])->name('investments.trash');

    // Trashed Investments
    Route::get('investments/trashed', [InvestmentController::class, 'trashed'])->name('investments.trashed');

    // Restore Trashed Investments
    Route::patch('investments/{investment}/restore', [InvestmentController::class, 'restore'])->name('investments.restore');

    // Investments
    Route::resource('investments', InvestmentController::class);
});
