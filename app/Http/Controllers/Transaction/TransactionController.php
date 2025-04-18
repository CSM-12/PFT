<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Models\Transaction\Transaction;
use App\Repositories\Contracts\Transaction\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    // Repository
    private $transactionRepository;

    // Inject the repository into the controller
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all categories
        $transactions = $this->transactionRepository->all();

        return view('pages.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        try {
            // Create the category
            $this->transactionRepository->create($request->all());

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Transaction added!']
            ]);

            // Return to the index page with a success message
            return redirect()->route('transactions.index');
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while adding transaction!']
            ]);

            // Log Error
            Log::error("Error creating transaction: " . $e->getMessage());

            // Return to the create page with an error message
            return redirect()->route('transactions.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $transaction = Transaction::findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('update', $transaction);

            // Get the category by ID
            $transaction = $this->transactionRepository->find($id);

            // Return the view with the category
            return view('pages.transactions.edit', compact('transaction'));
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Transaction not found!']
            ]);

            // Return to the index page with an error message
            return redirect()->back();
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while editing transaction!']
            ]);

            // Log Error
            Log::error("Error editing transaction: " . $e->getMessage());

            // Return to the index page with an error message
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, string $id)
    {
        try {
            $transaction = Transaction::findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('update', $transaction);
            
            // Find the record by ID and update
            $this->transactionRepository->update($request->all(), $id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Transaction Modified']
            ]);

            // Return to index page
            return redirect()->route('transactions.index');
        } catch (ModelNotFoundException $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Transaction Not found!']
            ]);

            // Return to edit pages
            return redirect()->back();
        } catch (\Exception $e) {
            // Prepare alert Massages
            session()->flash('alerts', [
                'error' => ['Transaction Not modified!', 'Something went wrong while modifing transaction!']
            ]);

            // Log error message
            Log::error("Something went wrong while modifing transaction with ID {$id}: " . $e->getMessage());

            // Return to edit pages
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the transaction
            $transaction = Transaction::withTrashed()->findOrFail($id);

            // Authorize to trash transaction (pass model, not ID)
            Gate::authorize('forceDelete', $transaction);

            // Find the game by ID
            $this->transactionRepository->destroy($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Transaction deleted!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Transaction not found!']
            ]);
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while deleting transaction!']
            ]);
            Log::error("Error deleting transaction transaction: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }

    /**
     * Trash the specified resource from storage.
     */
    public function trash(string $id)
    {
        try {
            // Find the transaction
            $transaction = Transaction::findOrFail($id);

            // Authorize to trash transaction (pass model, not ID)
            Gate::authorize('delete', $transaction);

            // Trash transaction
            $this->transactionRepository->trash($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Transaction trashed!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Transaction not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while trashing transaction!']
            ]);

            // Log error message
            Log::error("Error trashing transaction: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }

    /**
     * Show trashed transaction.
     */
    public function trashed()
    {
        try {
            // Trashe transactions
            $transactions = $this->transactionRepository->trashed();

            // Return trashed games view
            return view('pages.transactions.trashed', compact('transactions'));
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching trashed transaction: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while Showing trashed transactions!']
            ]);

            // Return to games index page
            return redirect()->back();
        }
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id)
    {
        try {
            // Find the transaction
            $transaction = Transaction::withTrashed()->findOrFail($id);

            // Authorize to trash transaction (pass model, not ID)
            Gate::authorize('restore', $transaction);

            // Find the trashed transaction by ID and restore it
            $this->transactionRepository->restore($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Transaction restored!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Log error message
            Log::error("Transaction not found: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Transaction not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while restoring transaction!']
            ]);

            // Log error message
            Log::error("Error restoring transaction: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }
}
