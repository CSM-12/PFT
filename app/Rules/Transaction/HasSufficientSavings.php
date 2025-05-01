<?php

namespace App\Rules\Transaction;

use App\Models\Saving\Saving;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class HasSufficientSavings implements ValidationRule
{
    protected string $category_id;

    public function __construct(string $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Run the validation rule. 
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get user id
        $userId = Auth::id();

        // Get saving transactions
        $savings = Saving::find($this->category_id);

        // Get sum of amount of savings with category id
        $balancedSaving = $savings->transactions()
            ->where('user_id', $userId)
            ->where('category_id', $this->category_id)
            ->sum('amount');

        // Check if saving has sufficient balance
        if ($balancedSaving < $value) {
            $fail("Insufficient savings in the saving category.");
        }
    }
}
