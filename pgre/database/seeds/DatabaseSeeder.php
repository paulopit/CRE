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
        $this->call(EquipmentModelSeeder::class);
        $this->call(EquipmentTypeSeeder::class);
        $this->call(EquipmentSeeder::class);
        $this->call(RequisitionLevelSeeder::class);

    }
}
