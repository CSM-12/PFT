<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    // Define fillable properties
    protected $fillable = [
        'user_id',
        'category_type',
        'category_id',
        'title',
        'description',
        'amount',
        'direction',
        'status',
    ];

    // Polymorphic relation with transaction categories, savings and investments
    public function category(): MorphTo
    {
        return $this->morphTo();
    }

    public function getDisplayCategoryTypeAttribute()
    {
        $mapping = [
            'App\\Models\\TransactionCategory' => 'Transaction',
            'App\\Models\\Investment\\Investment' => 'Investments',
            'App\\Models\\Saving\\Saving' => 'Savings',
        ];

        return $mapping[$this->category_type] ?? 'Unknown';
    }

    // Format output display date
    public function getDisplayCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y'); // Formats as "04 Feb 2025"
    }
}
