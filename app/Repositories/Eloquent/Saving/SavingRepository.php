<?php

namespace App\Repositories\Eloquent\Saving;

use App\Models\Saving\Saving;
use App\Repositories\Contracts\Saving\SavingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SavingRepository implements SavingRepositoryInterface
{
    // Get all categories
    public function all($search, $sortColumn, $sortDirection)
    {
        return Saving::where('user_id', Auth::id())
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('target_amount', 'like', "%$search%")
                    ->orWhere('platform', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'title', 'description', 'target_amount', 'target_date', 'platform', 'created_at']);
    }

    // Create a category
    public function create($data)
    {
        // User ID
        $data['user_id'] = Auth::id();

        return Saving::create($data);
    }

    // Get a category by ID
    public function find($id)
    {
        return Saving::select('id', 'icon', 'title', 'description', 'target_amount', 'target_date', 'platform')->findOrFail($id);
    }

    // Update a category
    public function update($data, $id)
    {
        $record = Saving::find($id)->update($data);
    }

    // Delete a category
    public function destroy($id)
    {
        $modeCategory = Saving::withTrashed()->findOrFail($id);
        return $modeCategory->forceDelete();
    }

    // Trash a category
    public function trash($id)
    {
        $modeCategory = Saving::findOrFail($id);
        return $modeCategory->delete();
    }

    // All trashed categories
    public function trashed($search, $sortColumn, $sortDirection)
    {
        // Fetch all trashed categories
        return $trashedGames = Saving::onlyTrashed()
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('target_amount', 'like', "%$search%")
                    ->orWhere('platform', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'title', 'description', 'target_amount', 'target_date', 'platform', 'created_at']);
    }

    // Restore trashed category
    public function restore($id)
    {
        // Find the trashed game by ID and restore it
        $game = Saving::onlyTrashed()->findOrFail($id)->restore();
    }
}
