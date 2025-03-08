<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use App\Repositories\Contracts\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('pages.transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->getCategories('transaction');

        return view('pages.transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get transaction category
     */
    public function getCategories(string $type)
    {
        $categories = null;

        if ($type == 'transaction') {
            $categories = TransactionCategory::where('user_id', Auth::id())->get(['id', 'name']);
        }

        return $categories;
    }
}
