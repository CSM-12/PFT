<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionCategory;
use App\Repositories\Contracts\TransactionCategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionCategoryRepository implements TransactionCategoryRepositoryInterface
{
    // Get all categories
    public function all()
    {
        return TransactionCategory::all(['id', 'name', 'description', 'created_at']);
    }

    // Create a category
    public function create($data)
    {
        // User ID
        $data['user_id'] = Auth::id();
        
        return TransactionCategory::create($data);
    }

    // Get a category by ID
    public function find($id)
    {
        return TransactionCategory::select('id', 'name', 'description')->findOrFail($id);
    }

    // Update a category
    public function update($data, $id)
    {
        $record = TransactionCategory::find($id)->update($data);
    }

    // Delete a category
    public function destroy($id)
    {
        $modeCategory = TransactionCategory::withTrashed()->findOrFail($id);
        return $modeCategory->forceDelete();
    }

    // Trash a category
    public function trash($id)
    {
        $modeCategory = TransactionCategory::findOrFail($id);
        return $modeCategory->delete();
    }

    // All trashed categories
    public function trashed()
    {
        // Fetch all trashed categories
        return $trashedGames = TransactionCategory::onlyTrashed()->get();
    }

    // Restore trashed category
    public function restore($id)
    {
        // Find the trashed game by ID and restore it
        $game = TransactionCategory::onlyTrashed()->findOrFail($id)->restore();
    }
}