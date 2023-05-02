<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NumeratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('numerators')->insert([
            [
                'model' => 'App\Models\Quote',
                'prefix' => 'D-',
                'suffix' => null,
                'date_format' => null,
                'next_number' => 1,
                'created_at' => '2023-04-29 03:59:54',
                'updated_at' => '2023-05-02 13:47:41',
            ],
            [
                'model' => 'App\Models\Invoice',
                'prefix' => 'F-',
                'suffix' => null,
                'date_format' => null,
                'next_number' => 1,
                'created_at' => '2023-04-29 04:14:31',
                'updated_at' => '2023-05-02 13:54:43',
            ],
            [
                'model' => 'App\Models\CreditNote',
                'prefix' => 'F-',
                'suffix' => null,
                'date_format' => null,
                'next_number' => 1,
                'created_at' => '2023-04-29 04:14:31',
                'updated_at' => '2023-05-02 13:54:43',
            ],
            [
                'model' => 'App\Models\Article',
                'prefix' => 'F-',
                'suffix' => null,
                'date_format' => null,
                'next_number' => 1,
                'created_at' => '2023-04-29 04:14:31',
                'updated_at' => '2023-05-02 13:54:43',
            ],
            [
                'model' => 'App\Models\Client',
                'prefix' => 'F-',
                'suffix' => null,
                'date_format' => null,
                'next_number' => 1,
                'created_at' => '2023-04-29 04:14:31',
                'updated_at' => '2023-05-02 13:54:43',
            ],
            [
                'model' => 'App\Models\Intervention',
                'prefix' => 'F-',
                'suffix' => null,
                'date_format' => null,
                'next_number' => 1,
                'created_at' => '2023-04-29 04:14:31',
                'updated_at' => '2023-05-02 13:54:43',
            ],
        ]);
    }
}
