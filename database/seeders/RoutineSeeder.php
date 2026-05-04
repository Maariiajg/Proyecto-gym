<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Routine;
use App\Models\Exercise;
use App\Models\User;

class RoutineSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@gym.com')->first();

        // Get some exercises
        $pecho = Exercise::where('name', 'Press de Banca Plano')->first();
        $espalda = Exercise::where('name', 'Dominadas (Pull-ups)')->first();
        $espalda2 = Exercise::where('name', 'Remo con Barra')->first();
        $pierna1 = Exercise::where('name', 'Sentadilla Libre con Barra')->first();
        $pierna2 = Exercise::where('name', 'Prensa de Piernas')->first();
        $hombro = Exercise::where('name', 'Press Militar con Barra')->first();
        $brazo1 = Exercise::where('name', 'Curl de Bíceps con Mancuernas')->first();
        $brazo2 = Exercise::where('name', 'Extensión de Tríceps en Polea')->first();

        if (!$pecho || !$admin) return;

        // Rutina 1: Full Body
        $routine1 = Routine::firstOrCreate(
            ['name' => 'Cuerpo Completo - Principiantes'],
            [
                'description' => 'Rutina ideal para quienes empiezan. Trabaja todos los grupos musculares en una sola sesión.',
                'creator_id' => $admin->id,
            ]
        );
        $routine1->exercises()->sync([
            $pierna2->id => ['sets' => 3, 'reps' => 12, 'rest_time_seconds' => 90],
            $pecho->id => ['sets' => 3, 'reps' => 10, 'rest_time_seconds' => 90],
            $espalda2->id => ['sets' => 3, 'reps' => 12, 'rest_time_seconds' => 90],
            $brazo1->id => ['sets' => 2, 'reps' => 15, 'rest_time_seconds' => 60],
        ]);

        // Rutina 2: Torso Fuerte
        $routine2 = Routine::firstOrCreate(
            ['name' => 'Día de Torso (Fuerza e Hipertrofia)'],
            [
                'description' => 'Enfocada en el tren superior: pecho, espalda, hombros y brazos.',
                'creator_id' => $admin->id,
            ]
        );
        $routine2->exercises()->sync([
            $pecho->id => ['sets' => 4, 'reps' => 8, 'rest_time_seconds' => 120],
            $espalda->id => ['sets' => 4, 'reps' => 8, 'rest_time_seconds' => 120],
            $hombro->id => ['sets' => 3, 'reps' => 10, 'rest_time_seconds' => 90],
            $brazo2->id => ['sets' => 3, 'reps' => 12, 'rest_time_seconds' => 60],
        ]);

        // Rutina 3: Tren Inferior
        $routine3 = Routine::firstOrCreate(
            ['name' => 'Piernas de Acero'],
            [
                'description' => 'Rutina intensa para maximizar el desarrollo de cuádriceps, isquiosurales y glúteos.',
                'creator_id' => $admin->id,
            ]
        );
        $routine3->exercises()->sync([
            $pierna1->id => ['sets' => 4, 'reps' => 6, 'rest_time_seconds' => 180],
            $pierna2->id => ['sets' => 4, 'reps' => 10, 'rest_time_seconds' => 120],
        ]);
    }
}
