<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'creator_id',
    ];

    /**
     * Get the user (trainer) who created the routine.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * The exercises that belong to the routine.
     */
    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class)
                    ->withPivot('sets', 'reps', 'rest_time_seconds')
                    ->withTimestamps();
    }
}
