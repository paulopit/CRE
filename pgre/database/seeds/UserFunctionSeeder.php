<?php

use Illuminate\Database\Seeder;

class UserFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_functions')->insert([
            [
                'function_name' => 'Colaborador',
                'created_at' => now(),
                'updated_at' => now()
            ],

            ['function_name' => 'Formador',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['function_name' => 'Estagiario',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['function_name' => 'Aluno',
            'created_at' => now(),
            'updated_at' => now()
            ]
        ]);
    }
}
