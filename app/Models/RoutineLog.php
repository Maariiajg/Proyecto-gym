<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutineLog extends Model
{
    protected $fillable = ['user_id', 'routine_id', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }
}
