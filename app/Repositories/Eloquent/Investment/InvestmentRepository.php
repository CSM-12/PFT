<?php

namespace App\Repositories\Eloquent\Investment;

use App\Models\Investment\Investment;
use App\Repositories\Contracts\Investment\InvestmentRepositoryInterface;

class InvestmentRepository implements InvestmentRepositoryInterface
{
    // Get all categories
    public function all()
    {
        return Investment::all(['id', 'title', 'description', 'investment_category', 'created_at']);
    }

    // Create a category
    public function create($data)
    {
        return Investment::create($data);
    }

    // Get a category by ID
    public function find($id)
    {
        return Investment::select('id', 'title', 'description', 'created_at')->findOrFail($id);
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
    public function trashed()
    {
        // Fetch all trashed categories
        return $trashedGames = Investment::onlyTrashed()->get();
    }

    // Restore trashed category
    public function restore($id)
    {
        // Find the trashed game by ID and restore it
        $game = Investment::onlyTrashed()->findOrFail($id)->restore();
    }
}