<?php

namespace App\Repositories\Eloquent\Transaction;

use App\Models\Investment\Investment;
use App\Models\Saving\Saving;
use App\Models\Transaction\Transaction;
use App\Models\TransactionCategory;
use App\Repositories\Contracts\Transaction\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all($search, $sortColumn, $sortDirection)
    {
        // transactions
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('category:id,title')
            ->where(function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%")
                        ->orWhere('amount', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                    })
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('title', 'like', "%$search%");
                    });
                })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'category_type', 'category_id', 'title', 'description', 'amount', 'direction', 'status', 'created_at']);
        
        return $transactions;
    }


    // Create a category
    public function create($data)
    {
        // User ID
        $data['user_id'] = Auth::id();


        // Determine category model
        switch ($data['category_type']) {
            case 'transaction':
                $category = TransactionCategory::find($data['category_id']);

                break;

            case 'saving':
                $category = Saving::find($data['category_id']);

                // // Condition: Ensure user has enough balance before creating a transaction
                // if ($category->balance < $data['amount']) {
                //     return response()->json(['message' => 'Insufficient balance in savings.'], 400);
                // }

                // Deduct the amount from savings balance
                // $category->balance -= $data['amount'];
                // $category->save();
                break;

            case 'investment':
                $category = Investment::find($data['category_id']);

                // Condition: Only allow transactions greater than $500 for investments
                // if ($data['amount'] < 500) {
                //     return response()->json(['message' => 'Investment transactions must be at least $500.'], 400);
                // }
                break;

            default:
                // return response()->json(['message' => 'Invalid category type.'], 400);
        }

        // Create the transaction
        $category->transactions()->create($data);
    }

    // Get a category by ID
    public function find($id)
    {
        return Transaction::with('category:id,title')
            ->where('id', $id)
            ->firstOrFail(['id', 'category_type', 'category_id', 'title', 'description', 'amount', 'direction', 'status', 'created_at']);
    }

    // Update a category
    public function update($data, $id)
    {

        // Determine category model
        switch ($data['category_type']) {
            case 'transaction':
                $data['category_type'] = 'App\Models\TransactionCategory';
                $category = TransactionCategory::find($data['category_id']);

                break;

            case 'saving':
                $data['category_type'] = 'App\Models\Saving\Saving';
                $category = Saving::find($data['category_id']);
                break;

            case 'investment':
                $data['category_type'] = 'App\Models\Investment\Investment';
                $category = Investment::find($data['category_id']);
                break;

            default:
                // return response()->json(['message' => 'Invalid category type.'], 400);
        }

        // Update transaction
        Transaction::find($id)->update($data);
    }

    // Delete a category
    public function destroy($id)
    {
        $transaction = Transaction::withTrashed()->findOrFail($id);
        return $transaction->forceDelete();
    }

    // Trash a category
    public function trash($id)
    {
        $transaction = Transaction::findOrFail($id);
        return $transaction->delete();
    }

    // All trashed categories
    public function trashed($search, $sortColumn, $sortDirection)
    {
        // Trashed transactions
        $transactions = Transaction::onlyTrashed()
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('amount', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%")
                    ->orWhere('category_type', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->select(['id', 'category_type', 'category_id', 'title', 'description', 'amount', 'direction', 'status', 'created_at']);
        
        return $transactions;
    }

    // Restore trashed transaction
    public function restore($id)
    {
        // Find the trashed game by ID and restore it
        $transaction = Transaction::onlyTrashed()->findOrFail($id)->restore();
    }
}
