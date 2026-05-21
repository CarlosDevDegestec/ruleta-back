<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        Question::create(['question' => '¿Cómo calificarías tu experiencia general?', 'type' => 'rating', 'order' => 1, 'is_active' => true]);
        Question::create(['question' => '¿Cómo calificarías la atención del personal?', 'type' => 'rating', 'order' => 2, 'is_active' => true]);
        Question::create(['question' => '¿Qué podríamos mejorar para tu próxima visita?', 'type' => 'text', 'order' => 3, 'is_active' => true]);
    }
}
