<?php

namespace App\Models;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class TransactionCategory extends Model
{
    use HasFactory, SoftDeletes;

    // Define fillable properties
    protected $fillable = [
        'user_id',
        'icon',
        'title',
        'description'
    ];

    // Polymorphic relation with transactions
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'category');
    }
}
