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
                'description' => 'Bateria Canon',
                'serial_number' => '20160202CCAA',
                'status_ok' => '1',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'BATERIACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Bateria Canon',
                'serial_number' => '20160301CCAA',
                'status_ok' => '1',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'BATERIACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Bateria Canon',
                'serial_number' => 'R41149853',
                'status_ok' => '1',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'BATERIACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Bateria Canon',
                'serial_number' => '201919',
                'status_ok' => '1',
                'equipment_type_id' => '1',
                'equipment_model_id' => '4',
                'reference' => 'BATERIACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Cabo Usb ',
                'serial_number' => ' ',
                'status_ok' => '1',
                'equipment_type_id' => '2',
                'equipment_model_id' => '1',
                'reference' => 'CABOUSBCANON100D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Cabo Usb ',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '2',
                'equipment_model_id' => '2',
                'reference' => 'CABOUSB',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],


            [
                'description' => 'Câmara',
                'serial_number' => '323055000393',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '2',
                'reference' => 'CAMARACANON90D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '343055002057',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '2',
                'reference' => 'CAMARACANON90D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '383073024269',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '1',
                'reference' => 'CAMARACANON100D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '373073012804',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '1',
                'reference' => 'CAMARACANON100D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '580310378',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '3',
                'reference' => 'CAMARACANON60D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => '223029002720',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '5',
                'reference' => 'CAMARAE0SR6',
                'obs' => 'Requisitada apenas com autorização HP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => 'S01-7455416',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '7',
                'reference' => 'CAMARASONY',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Câmara',
                'serial_number' => 'S01-2929351-H',
                'status_ok' => '1',
                'equipment_type_id' => '3',
                'equipment_model_id' => '7',
                'reference' => 'CAMARASONY',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Carregador com cabo',
                'serial_number' => 'R-41017361',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'CARREGADORCANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Carregador com cabo',
                'serial_number' => 'R-41017639',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'CARREGADORCANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Cartão de Memória',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'CARTAOMEMORIASDHC8GB',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Estabilizador ',
                'serial_number' => '24NDR - PI02006',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'ESTABILIZADORRONIN',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Fita ',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FITACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Fita ',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FITACANON100D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Fita ',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FITACANON60D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Fita ',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FITACANON90D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Fita ',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FITACANON90D',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Foco Projetor',
                'serial_number' => '6D132626',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FOCOPROJETORAPUTURE',
                'obs' => 'HP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Foco Projetor',
                'serial_number' => '6D133069',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'FOCOPROJETORAPUTURE',
                'obs' => 'HP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Micro Ambiente',
                'serial_number' => '762472',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'MICROAMBIENTERODE',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Micro Ambiente',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'MICROAMBIENTERODE',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Mochila de Costas',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'MOCHILACOSTASLOWEPRO',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Mochila de Mão',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'MOCHILACOSTASLOWEPRO',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Objetiva',
                'serial_number' => 'YN50MMF1.8',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'OBJETIVACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Objetiva',
                'serial_number' => 'EF-S 18-55mm1:3.5-5.6',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'OBJETIVACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Objetiva',
                'serial_number' => 'EF-S 17-55mm1:2.8',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'OBJETIVACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Objetiva',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'OBJETIVACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Objetiva',
                'serial_number' => 'EF 35mm 1:2',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'OBJETIVACANON',
                'obs' => 'Requisitada apenas com autorização HP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Objetiva',
                'serial_number' => 'ET-87',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'OBJETIVACANON',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Saco de Mão',
                'serial_number' => null,
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOMÃOAPUTURE',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Saco Tripé',
                'serial_number' => '328',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Saco Tripé',
                'serial_number' => 'W8521009',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Saco Tripé',
                'serial_number' => 'W852111',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Tripé',
                'serial_number' => 'TAC008A',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => 'TRIPEBENRO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Tripé',
                'serial_number' => 'KH25P',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => 'TRIPEBENRO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Tripé',
                'serial_number' => '315655',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => 'TRIPEBENRO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Tripé',
                'serial_number' => '315658',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => 'TRIPEBENRO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Tripé',
                'serial_number' => '326',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => 'TRIPEBENRO',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Tripé',
                'serial_number' => 'HX-80',
                'status_ok' => '1',
                'equipment_type_id' => '4',
                'equipment_model_id' => '4',
                'reference' => 'SACOTRIPEBENRO',
                'obs' => 'TRIPEHANIMEX',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
