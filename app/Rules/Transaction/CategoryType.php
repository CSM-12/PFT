<?php

namespace App\Rules\Transaction;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryType implements ValidationRule
{
    protected string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userId = Auth::id();

        // Map the type to the corresponding table
        $tableMap = [
            'transaction' => 'transaction_categories',
            'saving' => 'savings',
            'investment' => 'investments',
        ];

        // If the provided type is not valid, fail validation
        if (!isset($tableMap[$this->type])) {
            $fail("Invalid category selected.");
            return;
        }

        $table = $tableMap[$this->type];

        // Check if category_id exists in the correct table and belongs to the user
        $exists = DB::table($table)
            ->where('id', $value)
            ->where('user_id', $userId)
            ->exists();

        if (!$exists) {
            $fail("The selected category is invalid or does not created.");
        }
    }
}
