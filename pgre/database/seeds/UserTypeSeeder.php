<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_types')->insert([
            [
            'type_name' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now()
            ],

            ['type_name' => 'Técnico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['type_name' => 'Utilizador',
                'created_at' => now(),
                'updated_at' => now()
            ]



        ]);
    }
}
