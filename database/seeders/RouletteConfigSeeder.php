<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RouletteConfig;

class RouletteConfigSeeder extends Seeder
{
    public function run(): void
    {
        RouletteConfig::create([
            'title'     => '¡Gira y Gana Increíbles Premios!',
            'subtitle'  => 'Completa tu experiencia y prueba tu suerte',
            'is_active' => true,
        ]);
    }
}
