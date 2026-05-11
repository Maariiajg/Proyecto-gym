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

    protected static function booted()
    {
        static::addGlobalScope('visibility', function ($query) {
            if (auth()->check()) {
                $query->where(function ($q) {
                    $q->where('creator_id', auth()->id());
                    
                    if (!auth()->user()->hasRole('admin')) {
                        $q->orWhereHas('creator', function ($q2) {
                            $q2->whereHas('roles', function ($q3) {
                                $q3->where('name', 'admin');
                            });
                        });
                    }
                });
            }
        });
    }

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
