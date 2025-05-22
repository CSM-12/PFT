<?php

namespace App\Http\Controllers\Investment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Investment\StoreInvestmentRequest;
use App\Http\Requests\Investment\UpdateInvestmentRequest;
use App\Models\Investment\Investment;
use App\Repositories\Contracts\Investment\InvestmentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class InvestmentController extends Controller
{
    // Repository
    private $investmentRepository;

    // Inject the repository into the controller
    public function __construct(InvestmentRepositoryInterface $investmentRepository)
    {
        $this->investmentRepository = $investmentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all investments
            return view('pages.investments.index');
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching investments: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while showing investments!']
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
        return view('pages.investments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvestmentRequest $request)
    {
        try {
            // Create the category
            $this->investmentRepository->create($request->all());

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Investment plan added!']
            ]);

            // Return to the index page with a success message
            return redirect()->route('investments.index');
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while adding investment plan!']
            ]);

            // Log Error
            Log::error("Error creating investments: " . $e->getMessage());

            // Return to the create page with an error message
            return redirect()->back();
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
            $investment = Investment::findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('update', $investment);

            // Get the category by ID
            $investment = $this->investmentRepository->find($id);

            // Return the view with the category
            return view('pages.investments.edit', compact('investment'));
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Investment plan not found!']
            ]);

            // Return to the index page with an error message
            return redirect()->back();
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while editing investment plan!']
            ]);

            // Log Error
            Log::error("Error editing investment plan: " . $e->getMessage());

            // Return to the index page with an error message
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvestmentRequest $request, string $id)
    {
        try {
            // Find the record by ID and update
            $this->investmentRepository->update($request->all(), $id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Investment plan Modified']
            ]);

            // Return to index page
            return redirect()->route('investments.index');
        } catch (ModelNotFoundException $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Investments plan Not found!']
            ]);

            // Return to edit pages
            return redirect()->back();
        } catch (\Exception $e) {
            // Prepare alert Massages
            session()->flash('alerts', [
                'error' => ['Investment plan Not modified!', 'Something went wrong while modifing investment plan!']
            ]);

            // Log error message
            Log::error("Something went wrong while modifing investment plan with ID {$id}: " . $e->getMessage());

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
            // Find the investment
            $investment = Investment::withTrashed()->findOrFail($id);

            // Authorize to trash investment
            Gate::authorize('forceDelete', $investment);

            // Find the game by ID
            $this->investmentRepository->destroy($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Investment plan deleted!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Investment plan not found!']
            ]);
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while deleting investment plan!']
            ]);
            Log::error("Error deleting investment plan: " . $e->getMessage());
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
            // Find the saving
            $investment = Investment::findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('delete', $investment);

            // Trash Category
            $this->investmentRepository->trash($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Investment plan trashed!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Investment plan not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while trashing investment plan!']
            ]);

            // Log error message
            Log::error("Error trashing investment plan: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }

    public function trashed()
    {
        try {
            // Return trashed investments view
            return view('pages.investments.trashed');
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching trashed investments: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while Showing trashed investments!']
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
            // Find the saving
            $investment = Investment::withTrashed()->findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('restore', $investment);

            // Find the trashed game by ID and restore it
            $this->investmentRepository->restore($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Investment plan restored!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Investment plan not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while restoring investment plan!']
            ]);

            // Log error message
            Log::error("Error restoring investment plan: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->route('investments.index');
        }
    }
}
