<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Jenis_pengdiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_pengdiris')->insert([
            'name_jp'     => 'dummy permanent',
            'category'    => 0,
        ]);

        DB::table('jenis_pengdiris')->insert([
            'name_jp'     => 'media pembelajaran',
            'category'    => 1,
        ]);

        DB::table('jenis_pengdiris')->insert([
            'name_jp'     => 'publikasi ilmiah',
            'category'    => 1,
        ]);

        DB::table('jenis_pengdiris')->insert([
            'name_jp'     => 'aktivitas sosial',
            'category'    => 1,
        ]);
    }
}
