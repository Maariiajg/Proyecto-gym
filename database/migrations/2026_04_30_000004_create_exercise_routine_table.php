<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Routine;
use App\Models\Exercise;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_routine', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Routine::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Exercise::class)->constrained()->cascadeOnDelete();
            $table->integer('sets');
            $table->string('reps'); // Use string as requested (string/integer) to allow "10-12" etc.
            $table->integer('rest_time_seconds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_routine');
    }
};
