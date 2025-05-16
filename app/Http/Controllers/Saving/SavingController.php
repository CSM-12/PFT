<?php

namespace App\Http\Controllers\Saving;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Saving\SavingRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Saving\StoreSavingRequest;
use App\Http\Requests\Saving\UpdateSavingRequest;
use App\Models\Saving\Saving;
use Illuminate\Support\Facades\Gate;

class SavingController extends Controller
{
    // Repository
    private $savingRepository;

    // Inject the repository into the controller
    public function __construct(SavingRepositoryInterface $savingRepository)
    {
        $this->savingRepository = $savingRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all categories
        return view('pages.savings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.savings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSavingRequest $request)
    {
        try {
            // Create the category
            $this->savingRepository->create($request->all());

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Saving plan added!']
            ]);

            // Return to the index page with a success message
            return redirect()->route('savings.index');
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while adding savings plan!']
            ]);

            // Log Error
            Log::error("Error creating savings: " . $e->getMessage());

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
            $saving = Saving::findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('update', $saving);

            // Get the category by ID
            $saving = $this->savingRepository->find($id);

            // Return the view with the category
            return view('pages.savings.edit', compact('saving'));
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Saving plan not found!']
            ]);

            // Return to the index page with an error message
            return redirect()->back();
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'danger' => ['Something went wrong while editing saving plan!']
            ]);

            // Log Error
            Log::error("Error editing savings plan: " . $e->getMessage());

            // Return to the index page with an error message
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSavingRequest $request, string $id)
    {
        try {
            // Find the record by ID and update
            $this->savingRepository->update($request->all(), $id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Savings plan Modified']
            ]);

            // Return to index page
            return redirect()->route('savings.index');
        } catch (ModelNotFoundException $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Savings plan Not found!']
            ]);

            // Return to edit pages
            return redirect()->back();
        } catch (\Exception $e) {
            // Prepare alert Massages
            session()->flash('alerts', [
                'error' => ['Savings plan Not modified!', 'Something went wrong while modifing savings plan!']
            ]);

            // Log error message
            Log::error("Something went wrong while modifing savings plan with ID {$id}: " . $e->getMessage());

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
            // Find the saving
            $saving = Saving::withTrashed()->findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('forceDelete', $saving);

            // Find the game by ID
            $this->savingRepository->destroy($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Savings plan deleted!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Savings plan not found!']
            ]);
        } catch (\Exception $e) {

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while deleting Savings plan!']
            ]);
            Log::error("Error deleting Savings plan: " . $e->getMessage());
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
            $saving = Saving::findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('delete', $saving);

            // Trash saving
            $this->savingRepository->trash($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Savings plan trashed!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Savings plan not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while trashing savings plan!']
            ]);

            // Log error message
            Log::error("Error trashing savings plan: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->back();
        }
    }

    public function trashed()
    {
        try {
            // Trash Category
            $savings = $this->savingRepository->trashed();

            // Return trashed games view
            return view('pages.savings.trashed', compact('savings'));
        } catch (\Exception $e) {
            // Log error message
            Log::error("Error fetching trashed savings: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while Showing trashed savings!']
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
            $saving = Saving::withTrashed()->findOrFail($id);

            // Authorize to trash saving
            Gate::authorize('restore', $saving);

            // Find the trashed game by ID and restore it
            $this->savingRepository->restore($id);

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Savings plan restored!']
            ]);
        } catch (ModelNotFoundException $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Savings plan not found!']
            ]);
        } catch (\Exception $e) {
            // Prepare alert message
            session()->flash('alerts', [
                'error' => ['Something went wrong while restoring Savings plan!']
            ]);

            // Log error message
            Log::error("Error restoring Savings plan: " . $e->getMessage());
        } finally {
            // Redirect to games index page
            return redirect()->route('savings.index');
        }
    }
}
