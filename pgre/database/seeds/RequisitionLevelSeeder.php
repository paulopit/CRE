<?php

use Illuminate\Database\Seeder;

class RequisitionLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('requisition_levels')->insert([
            [
                'name' => 'Temporário',
                'close_type' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Submetido',
                'close_type' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Aguarda Levantamento',
                'close_type' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Requisitado',
                'close_type' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Expirado',
                'close_type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cancelado',
                'close_type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Rejeitado',
                'close_type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Devolvido',
                'close_type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
