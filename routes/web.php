<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Investment\InvestmentController;
use App\Http\Controllers\Saving\SavingController;
use App\Http\Controllers\Support\SupportController;
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


// ----------------- Reset Password -----------------
// Forgot password form
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.request');

// Password reset link
Route::post('/forgot-password', [AuthController::class, 'sendForgotPasswordLink'])
    ->middleware('guest')
    ->name('password.email');

// Reset password form
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');

// Update password
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');


// Authorizing user
Route::middleware(['auth', AuthorizeRole::class . ':user'])->group(function () {

    // dashboard
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // Settings
    Route::get('/settings', [AuthController::class, 'showSettings'])->name('settings.index');
    Route::patch('/settings', [AuthController::class, 'updateSettings'])->name('settings.update');


    // transactions
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

    // Trash Transaction
    Route::patch('transactions/{transaction}/trash', [TransactionController::class, 'trash'])->name('transaction.trash');

    // Trashed Categories
    Route::get('transactions/trashed', [TransactionController::class, 'trashed'])->name('transactions.trashed');

    // Restore Trashed Category
    Route::patch('transactions/{transaction}/restore', [TransactionController::class, 'restore'])->name('transactions.restore');

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


    // ----------------- Support -----------------
    // Show form
    Route::get('/support', [SupportController::class, 'create'])->name('support.create');

    // Send support
    Route::post('/support', [SupportController::class, 'send'])->name('support.send');
});
