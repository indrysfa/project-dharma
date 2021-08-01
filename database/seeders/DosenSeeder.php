<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosens')->insert([
            'name'              => ucwords('Dosen 01'),
            'user_id'           => strtolower('dosen01'),
            'status'            => 'aktif',
        ]);

        DB::table('dosens')->insert([
            'name'              => ucwords('Dosen 02'),
            'user_id'           => strtolower('dosen02'),
            'status'            => 'aktif',
        ]);
    }
}
