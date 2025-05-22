<?php

namespace App\Repositories\Eloquent\Investment;

use App\Models\Investment\Investment;
use App\Repositories\Contracts\Investment\InvestmentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class InvestmentRepository implements InvestmentRepositoryInterface
{
    // Get all categories
    public function all($search, $sortColumn, $sortDirection)
    {
        return Investment::where('user_id', Auth::id())
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'title', 'description', 'investment_category', 'created_at']);
    }

    // Create a category
    public function create($data)
    {
        // User ID
        $data['user_id'] = Auth::id();

        return Investment::create($data);
    }

    // Get a category by ID
    public function find($id)
    {
        return Investment::select('id', 'icon', 'title', 'description', 'created_at')->findOrFail($id);
    }

    // Update a category
    public function update($data, $id)
    {
        $record = Investment::find($id)->update($data);
    }

    // Delete a category
    public function destroy($id)
    {
        $modeCategory = Investment::withTrashed()->findOrFail($id);
        return $modeCategory->forceDelete();
    }

    // Trash a category
    public function trash($id)
    {
        $modeCategory = Investment::findOrFail($id);
        return $modeCategory->delete();
    }

    // All trashed categories
    public function trashed($search, $sortColumn, $sortDirection)
    {
        // Fetch all trashed categories
        return $trashedGames = Investment::onlyTrashed()
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'title', 'description', 'investment_category', 'created_at']);
    }

    // Restore trashed category
    public function restore($id)
    {
        // Find the trashed game by ID and restore it
        $game = Investment::onlyTrashed()->findOrFail($id)->restore();
    }
}