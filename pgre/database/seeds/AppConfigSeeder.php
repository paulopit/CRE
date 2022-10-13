<?php

use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('app_configs')->insert(
            [
                'app_name' => 'GRE - Gestão de Requisição de Equipamentos',
                'app_logo' => null,
                'conf_alert_emails' => '',
                'conf_low_stock_percentage' => 10,
                'conf_default_req_days' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
