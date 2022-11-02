<?php

use Illuminate\Database\Seeder;

class EquipmentModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('equipment_models')->insert([
            [
                'name' => 'Outros',
                'brand_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '100D',
                'brand_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '90D',
                'brand_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '60D',
                'brand_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'R6',
                'brand_id' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '6',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '7',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '8',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '9',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Outros',
                'brand_id' => '11',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
