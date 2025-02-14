<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TransactionCategory extends Model
{
    use HasFactory, SoftDeletes;

    // Define fillable properties
    protected $fillable = [
        'name',
        'description'
    ];

    // Format output date
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y'); // Formats as "04 Feb 2025"
    }

    // Define the scope to fetch a game by its ID
    // public function scopeGameId($query, $gameId)
    // {
    //     return $query->where('id', $gameId);
    // }
}
