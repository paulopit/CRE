<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('brands')->insert([
            [
                'name' => 'Outras',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Canon',
                'created_at' => now(),
                'updated_at' => now()
            ],

            ['name' => 'E0S',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Sony',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'SDHC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Ronin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Aputure',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Rode',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Lowepro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Benro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            ['name' => 'Hanimex',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
