<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'jja_id'        => 1,
            'user_id'       => strtolower('dosen01'),
            'kode'          => 88055,
            'status'        => 'aktif',
            'name_dsn'      => ucwords('Dr. I Nyoman Suardana, M.Si.'),
            'tmptlahir'     => 'Jakarta',
            'tgl_lahir'     => '1976-07-28',
            'email'         => 'dosen01@mail.com',
            'no_telepon'     => '089127382482',
            'alamat'        => ucwords('Jl. Pasukan'),
            'picture'       => '',
        ]);

        DB::table('dosens')->insert([
            'jja_id'        => 2,
            'user_id'       => strtolower('dosen02'),
            'kode'          => 88056,
            'status'        => 'aktif',
            'name_dsn'      => ucwords('Dr. Dewa Bagus Sanjaya, M.Si.'),
            'tmptlahir'     => 'Jakarta',
            'tgl_lahir'     => '1985-07-13',
            'email'         => 'dosen02@mail.com',
            'no_telepon'     => '089127382483',
            'alamat'        => ucwords('Jl. Garuda'),
            'picture'       => '',
        ]);
    }
}
