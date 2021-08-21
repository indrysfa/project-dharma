<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jenis_penelitianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_penelitians')->insert([
            'name_jns_penelitian'   => 'dummy permanent',
            'category'              => 0,
        ]);

        DB::table('jenis_penelitians')->insert([
            'name_jns_penelitian'   => 'Tipe 1',
            'category'              => 1,
        ]);

        DB::table('jenis_penelitians')->insert([
            'name_jns_penelitian'   => 'Tipe 2',
            'category'              => 1,
        ]);
    }
}
