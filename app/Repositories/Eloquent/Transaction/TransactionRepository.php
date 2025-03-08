<?php

namespace App\Repositories\Eloquent\Transaction;

use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface
{
    // Get all categories
    public function all()
    {
    }

    // Create a category
    public function create($data)
    {
        // User ID
        $data['user_id'] = Auth::id();

        return Transaction::create($data);
    }

    // Get a category by ID
    public function find($id)
    {
    }

    // Update a category
    public function update($data, $id)
    {
    }

    // Delete a category
    public function destroy($id)
    {
    }

    // Trash a category
    public function trash($id)
    {
    }

    // All trashed categories
    public function trashed()
    {
    }

    // Restore trashed category
    public function restore($id)
    {
    }
}