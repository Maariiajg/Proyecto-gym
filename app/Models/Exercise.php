<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'muscle_group',
        'media_url',
    ];

    /**
     * The routines that belong to the exercise.
     */
    public function routines(): BelongsToMany
    {
        return $this->belongsToMany(Routine::class)
                    ->withPivot('sets', 'reps', 'rest_time_seconds')
                    ->withTimestamps();
    }
}
