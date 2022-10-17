<?php

use Illuminate\Database\Seeder;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('equipment_types')->insert([
            [
                'type' => 'Bateria',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Cabo USB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Câmara',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Carregador com cabo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Cartão de memória',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Estabilizador',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Fita',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Foco Projetor',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Micro Ambiente',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Mochila de costas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Mochila de mão',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Objetiva',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Saco de mão',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Saco de tripé',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'type' => 'Tripé',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
