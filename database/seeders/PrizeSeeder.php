<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prize;

class PrizeSeeder extends Seeder
{
    public function run(): void
    {
        $prizes = [
            ['name' => 'Bebida Gratis',         'rarity' => 'comun',      'weight' => 15],
            ['name' => 'Postre Gratis',          'rarity' => 'comun',      'weight' => 15],
            ['name' => '10% de Descuento',       'rarity' => 'poco_comun', 'weight' => 8],
            ['name' => 'Entrada 2x1',            'rarity' => 'poco_comun', 'weight' => 8],
            ['name' => 'Menú del Día Gratis',    'rarity' => 'raro',       'weight' => 5],
            ['name' => 'Cena para Dos',          'rarity' => 'epico',      'weight' => 3],
            ['name' => 'Experiencia VIP',        'rarity' => 'epico',      'weight' => 3],
            ['name' => 'Fin de Semana Todo Incluido', 'rarity' => 'legendario', 'weight' => 1],
        ];

        foreach ($prizes as $prize) {
            Prize::create(array_merge($prize, ['is_active' => true]));
        }
    }
}
