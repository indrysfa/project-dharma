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
            'name_dsn'      => ucwords('Dosen 01'),
            'tmptlahir'     => 'Jakarta',
            'tgl_lahir'     => '2020-07-28',
            'email'         => 'dosen01@mail.com',
            'no_telpon'     => '089127382482',
            'alamat'        => ucwords('Jl. Pasukan'),
            'picture'       => '',
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Dosen 01'),
            'username'          => strtolower('dosen01'),
            'email'             => 'dosen01@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 3,
            'tmptlahir'         => ucwords('jakarta'),
            'tgl_lahir'         => '2020-07-28',
            'no_telepon'        => '089127382482',
            'alamat'            => ucwords('Jl. Pasukan'),
            'picture'           => '',
        ]);

        DB::table('dosens')->insert([
            'jja_id'        => 1,
            'user_id'       => strtolower('dosen02'),
            'kode'          => 88056,
            'status'        => 'aktif',
            'name_dsn'      => ucwords('Dosen 02'),
            'tmptlahir'     => 'Jakarta',
            'tgl_lahir'     => '2020-07-13',
            'email'         => 'dosen02@mail.com',
            'no_telpon'     => '089127382483',
            'alamat'        => ucwords('Jl. Garuda'),
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Dosen 02'),
            'username'          => strtolower('dosen02'),
            'email'             => 'dosen02@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 3,
            'tmptlahir'         => ucwords('jakarta'),
            'tgl_lahir'         => '2020-07-13',
            'no_telepon'        => '089127382483',
            'alamat'            => ucwords('Jl. Garuda'),
            'picture'           => '',
        ]);
    }
}
