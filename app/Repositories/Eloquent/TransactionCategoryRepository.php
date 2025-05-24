<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionCategory;
use App\Repositories\Contracts\TransactionCategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionCategoryRepository implements TransactionCategoryRepositoryInterface
{
    // Get all categories
    public function all($search, $sortColumn, $sortDirection)
    {
        return TransactionCategory::where('user_id', Auth::id())
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'title', 'description', 'created_at']);
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
        return TransactionCategory::select('id', 'icon', 'title', 'description')->findOrFail($id);
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
    public function trashed($search, $sortColumn, $sortDirection)
    {
        $categories = TransactionCategory::where('user_id', Auth::id())
            ->onlyTrashed()
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'title', 'description', 'created_at']);

        return $categories;
    }

    // Restore trashed category
    public function restore($id)
    {
        // Find the trashed game by ID and restore it
        $game = TransactionCategory::onlyTrashed()->findOrFail($id)->restore();
    }
}
