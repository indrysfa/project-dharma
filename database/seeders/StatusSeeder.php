<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name'  => 'aktif',
            'code'  => 1,
            'group' => 'user',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'nonaktif',
            'code'  => 0,
            'group' => 'user',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'new',
            'code'  => 1,
            'group' => 'penelitian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'done',
            'code'  => 2,
            'group' => 'penelitian',
        ]);
    }
}
