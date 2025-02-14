<?php

namespace App\Models\Investment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Investment extends Model
{
    use HasFactory, SoftDeletes;

    // Define fillable properties
    protected $fillable = [
        'title',
        'description'
    ];

    // Format output date
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y'); // Formats as "04 Feb 2025"
    }
}
