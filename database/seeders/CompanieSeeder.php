<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'MS CONCEPT',
                'email' => 'contact@msconcepts.fr',
                'phone_number' => '03 90 59 47 78',
                'website' => 'https://msconcepts.fr',
                'address' => '57 Rte de Marienthal',
                'city' => 'Haguenau',
                'postal_code' => '67500',
                'country' => 'France',
                'logo' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
