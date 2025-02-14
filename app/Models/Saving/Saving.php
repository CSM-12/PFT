<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Saving extends Model
{
    use HasFactory, SoftDeletes;

    // Define fillable properties
    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'target_date',
        'platform'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y'); // Formats as "04 Feb 2025"
    }
}
