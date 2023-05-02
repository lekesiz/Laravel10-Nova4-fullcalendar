<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mikail',
            'last_name' => 'Lekesiz',
            'email' => 'mikail@lekesiz.org',
            'email_verified_at' => now(),
            'password' => Hash::make('Mikail1985'),
            'username' => 'mikaillekesiz',
            'color' => null,
            'mobile' => null,
            'is_active' => 1,
            'role_id' => 1,
            'avatar' => null,
            'addresse' => null,
            'is_admin' => 1,
            'last_login' => now(),
            'deleted_at' => null,
            'note' => null,
            'nir' => null,
            'last_activity' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}