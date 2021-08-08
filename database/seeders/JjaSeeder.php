<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jjas')->insert([
            'name'            => 'Tetap',
        ]);

        DB::table('jjas')->insert([
            'name'            => 'Tidak Tetap',
        ]);

        DB::table('jjas')->insert([
            'name'            => 'Honorer',
        ]);

        DB::table('jjas')->insert([
            'name'            => 'Rektor',
        ]);
    }
}
