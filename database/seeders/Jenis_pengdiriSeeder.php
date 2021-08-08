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
            'name_jp'     => 'media pembelajaran',
        ]);

        DB::table('jenis_pengdiris')->insert([
            'name_jp'     => 'publikasi ilmiah',
        ]);

        DB::table('jenis_pengdiris')->insert([
            'name_jp'     => 'aktivitas sosial',
        ]);
    }
}
