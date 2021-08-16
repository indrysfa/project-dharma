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
            'group' => 'dosen',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'nonaktif',
            'code'  => 0,
            'group' => 'dosen',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'aktif',
            'code'  => 1,
            'group' => 'matkul',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'nonaktif',
            'code'  => 0,
            'group' => 'matkul',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'submit',
            'code'  => 1,
            'group' => 'penelitian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'approved',
            'code'  => 2,
            'group' => 'penelitian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'reported',
            'code'  => 3,
            'group' => 'penelitian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'submit',
            'code'  => 1,
            'group' => 'pengajaran',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'approved',
            'code'  => 2,
            'group' => 'pengajaran',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'reported',
            'code'  => 3,
            'group' => 'pengajaran',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'submit',
            'code'  => 1,
            'group' => 'pengabdian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'approved',
            'code'  => 2,
            'group' => 'pengabdian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'reported',
            'code'  => 3,
            'group' => 'pengabdian',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'submit',
            'code'  => 1,
            'group' => 'pengembangan',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'approved',
            'code'  => 2,
            'group' => 'pengembangan',
        ]);

        DB::table('statuses')->insert([
            'name'  => 'reported',
            'code'  => 3,
            'group' => 'pengembangan',
        ]);
    }
}
