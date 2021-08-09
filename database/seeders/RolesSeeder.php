<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name_r'  => 'Language Center',
        ]);

        DB::table('roles')->insert([
            'name_r'  => 'Admin',
        ]);

        DB::table('roles')->insert([
            'name_r'  => 'Dosen',
        ]);
    }
}
