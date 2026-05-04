<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $exercises = [
            [
                'name' => 'Press de Banca Plano',
                'description' => 'Ejercicio principal para el desarrollo del pectoral mayor.',
                'target_muscle' => 'Pecho',
                'difficulty_level' => 'intermedio',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\press_de_banca_1777895893789.png',
            ],
            [
                'name' => 'Sentadilla Libre con Barra',
                'description' => 'El rey de los ejercicios para el tren inferior, trabaja cuádriceps, glúteos e isquiosurales.',
                'target_muscle' => 'Piernas',
                'difficulty_level' => 'avanzado',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\sentadilla_libre_1777895908354.png',
            ],
            [
                'name' => 'Peso Muerto Convencional',
                'description' => 'Ejercicio compuesto que trabaja toda la cadena posterior del cuerpo.',
                'target_muscle' => 'Espalda',
                'difficulty_level' => 'avanzado',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\peso_muerto_1777895923657.png',
            ],
            [
                'name' => 'Dominadas (Pull-ups)',
                'description' => 'Ejercicio con peso corporal excelente para el desarrollo de la espalda y bíceps.',
                'target_muscle' => 'Espalda',
                'difficulty_level' => 'intermedio',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\dominadas_1777895937465.png',
            ],
            [
                'name' => 'Press Militar con Barra',
                'description' => 'Ejercicio de empuje vertical para desarrollar los hombros.',
                'target_muscle' => 'Hombros',
                'difficulty_level' => 'intermedio',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\press_militar_1777895951371.png',
            ],
            [
                'name' => 'Curl de Bíceps con Mancuernas',
                'description' => 'Ejercicio analítico para el desarrollo de los flexores del codo.',
                'target_muscle' => 'Brazos',
                'difficulty_level' => 'principiante',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\curl_biceps_1777895969780.png',
            ],
            [
                'name' => 'Extensión de Tríceps en Polea',
                'description' => 'Aislamiento de la musculatura del tríceps braquial.',
                'target_muscle' => 'Brazos',
                'difficulty_level' => 'principiante',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\extension_triceps_1777895983960.png',
            ],
            [
                'name' => 'Elevaciones Laterales',
                'description' => 'Aislamiento de la porción lateral del deltoides.',
                'target_muscle' => 'Hombros',
                'difficulty_level' => 'principiante',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\elevaciones_laterales_1777895999062.png',
            ],
            [
                'name' => 'Remo con Barra',
                'description' => 'Ejercicio compuesto de tirón horizontal para la espalda.',
                'target_muscle' => 'Espalda',
                'difficulty_level' => 'intermedio',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\remo_barra_1777896012621.png',
            ],
            [
                'name' => 'Prensa de Piernas',
                'description' => 'Ejercicio en máquina guiada para trabajar cuádriceps y glúteos de forma segura.',
                'target_muscle' => 'Piernas',
                'difficulty_level' => 'principiante',
                'image_path' => 'C:\Users\aprigar802\.gemini\antigravity\brain\5f59a32e-3caf-4c6c-8814-3836783264ed\prensa_piernas_1777896027276.png',
            ]
        ];

        foreach ($exercises as $exerciseData) {
            $imagePath = $exerciseData['image_path'];
            unset($exerciseData['image_path']);
            
            $exercise = Exercise::firstOrCreate(['name' => $exerciseData['name']], $exerciseData);
            
            if (file_exists($imagePath) && $exercise->getMedia('exercises')->count() === 0) {
                $exercise->addMedia($imagePath)->preservingOriginal()->toMediaCollection('exercises');
            }
        }
    }
}
