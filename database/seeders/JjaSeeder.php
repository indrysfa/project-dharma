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
            'name'            => 'TP',
        ]);

        DB::table('jjas')->insert([
            'name'            => 'AA',
        ]);

        DB::table('jjas')->insert([
            'name'            => 'Lektor',
        ]);

        DB::table('jjas')->insert([
            'name'            => 'Lektor Kepala / S3',
        ]);
    }
}
