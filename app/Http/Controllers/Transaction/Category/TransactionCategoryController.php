<?php

namespace App\Http\Controllers\Transaction\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\Category\StoreTransactionCategoryRequest;
use App\Http\Requests\Transaction\Category\UpdateTransactionCategoryRequest;
use App\Repositories\Contracts\TransactionCategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TransactionCategoryController extends Controller
{
    // Repository
    private $transactionCategoryRepository;

    // Inject the repository into the controller
    public function __construct(TransactionCategoryRepositoryInterface $transactionCategoryRepository)
    {
        $this->transactionCategoryRepository = $transactionCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all investments
            return view('pages.transactions.categories.index');
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching transactions categories: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while showing transactions categories!']
            ]);

            // Return to games index page
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.transactions.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionCategoryRequest $request)
    {
        try {
            // Create the category
            $this->transactionCategoryRepository->create($request->all());

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Transaction category added!']
            ]);

            // Return to the index page with a success message
            return redirect()->route('transactions.categories.index');
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while adding category!']
            ]);

            // Log Error
            Log::error("Error creating transaction category: " . $e->getMessage());

            // Return to the create page with an error message
            return redirect()->route('transactions.categories.create');
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
            // Get the category by ID
            $category = $this->transactionCategoryRepository->find($id);

            // Return the view with the category
            return view('pages.transactions.categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Category not found!']
            ]);

            // Return to the index page with an error message
            return redirect()->back();
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while editing category!']
            ]);

            // Log Error
            Log::error("Error editing transaction category: " . $e->getMessage());

            // Return to the index page with an error message
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionCategoryRequest $request, string $id)
    {
        try {
            // Find the record by ID and update
            $this->transactionCategoryRepository->update($request->all(), $id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Category Modified']
            ]);

            // Return to index page
            return redirect()->route('transactions.categories.index');
        } catch (ModelNotFoundException $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Category Not found!']
            ]);

            // Return to edit pages
            return redirect()->back();
        } catch (\Exception $e) {
            // Prepare alert Massages
            session()->flash('alerts', [
                'error' => ['Category Not modified!', 'Something went wrong while modifing Category!']
            ]);

            // Log error message
            Log::error("Something went wrong while modifing transaction category with ID {$id}: " . $e->getMessage());

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
            // Find the game by ID
            $this->transactionCategoryRepository->destroy($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Category deleted!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Category not found!']
            ]);
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while deleting category!']
            ]);
            Log::error("Error deleting transaction category: " . $e->getMessage());
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
            // Trash Category
            $this->transactionCategoryRepository->trash($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Category trashed!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Category not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while trashing category!']
            ]);

            // Log error message
            Log::error("Error trashing transaction category: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }

    public function trashed()
    {
        try {
            // Return trashed games view
            return view('pages.transactions.categories.trashed');
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching trashed transaction categories: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while Showing trashed transaction categories!']
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
            // Find the trashed game by ID and restore it
            $this->transactionCategoryRepository->restore($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Category restored!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Category not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while restoring category!']
            ]);

            // Log error message
            Log::error("Error restoring transaction category: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }
}