<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AppConfigSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(UserFunctionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);

    }
}
