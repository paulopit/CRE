<?php

use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('equipment')->insert([
            [
                'description' => 'Batéria Canon',
                'serial_number' => '20160202CCAA',
                'status_ok' => '0',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'A1',
                'obs' => 'Bateria XPTO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Batéria Canon',
                'serial_number' => '20160301CCAA',
                'status_ok' => '0',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'A2',
                'obs' => 'Bateria XPTO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Batéria Canon',
                'serial_number' => 'R41149853',
                'status_ok' => '0',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'A3',
                'obs' => 'Bateria XPTO2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Batéria Canon',
                'serial_number' => '201919',
                'status_ok' => '0',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'A4',
                'obs' => 'Bateria XPTO3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Cabo Usb ',
                'serial_number' => '111',
                'status_ok' => '0',
                'equipment_type_id' => '2',
                'equipment_model_id' => '1',
                'reference' => 'A5',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Cabo Usb ',
                'serial_number' => '222',
                'status_ok' => '0',
                'equipment_type_id' => '2',
                'equipment_model_id' => '2',
                'reference' => 'A6',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'description' => 'Cabo Usb',
                'serial_number' => '333',
                'status_ok' => '0',
                'equipment_type_id' => '2',
                'equipment_model_id' => '2',
                'reference' => 'A7',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '323055000393',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '2',
                'reference' => 'A8',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '343055002057',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '2',
                'reference' => 'A9',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '383073024269',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '1',
                'reference' => 'A10',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '373073012804',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '1',
                'reference' => 'A11',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '580310378',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '3',
                'reference' => 'A12',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '223029002720',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '5',
                'reference' => 'A13',
                'obs' => 'Requisitada apenas com autorização HP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => 'S01-7455416',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '7',
                'reference' => 'A14',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => 'S01-2929351-H',
                'status_ok' => '0',
                'equipment_type_id' => '3',
                'equipment_model_id' => '7',
                'reference' => 'A15',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => 'R-41017361',
                'status_ok' => '0',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'A16',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
