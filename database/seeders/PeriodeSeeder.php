<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('periodes')->insert([
            'tahun'     => 2021,
            'semester'  => 1,
        ]);

        DB::table('periodes')->insert([
            'tahun'     => 2021,
            'semester'  => 2,
        ]);

        DB::table('periodes')->insert([
            'tahun'     => 2022,
            'semester'  => 1,
        ]);

        DB::table('periodes')->insert([
            'tahun'     => 2022,
            'semester'  => 2,
        ]);

        DB::table('periodes')->insert([
            'tahun'     => 2023,
            'semester'  => 1,
        ]);

        DB::table('periodes')->insert([
            'tahun'     => 2023,
            'semester'  => 2,
        ]);
    }
}
