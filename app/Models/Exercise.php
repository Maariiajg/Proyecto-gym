<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Exercise extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'target_muscle',
        'video_url',
        'difficulty_level',
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
