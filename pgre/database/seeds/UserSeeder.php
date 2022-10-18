<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'phone' => null,
                'birth_date' => carbon::createFromDate(1900, 1, 1),
                'user_function_id' => 1,
                'user_type_id' => 1,
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tecnico',
                'phone' => null,
                'birth_date' => carbon::createFromDate(1900, 1, 1),
                'user_function_id' => 2,
                'user_type_id' => 2,
                'email' => 'tecnico@admin.com',
                'password' => Hash::make('tecnico'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Aluno',
                'phone' => null,
                'birth_date' => carbon::createFromDate(1900, 1, 1),
                'user_function_id' => 4,
                'user_type_id' => 3,
                'email' => 'aluno@admin.com',
                'password' => Hash::make('aluno'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
