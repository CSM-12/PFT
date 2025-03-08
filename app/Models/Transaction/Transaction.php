<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    // Define fillable properties
    protected $fillable = [
        'user_id',
        'type',
        'category_id',
        'title',
        'description',
        'amount',
        'direction',
        'status',
    ];
}
