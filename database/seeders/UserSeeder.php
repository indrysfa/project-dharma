<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => ucwords('LC 01'),
            'username'          => strtolower('lc01'),
            'email'             => 'lc@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 1,
            'tmptlahir'         => ucwords('jakarta'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '08912345678',
            'alamat'            => ucwords('Jl. Merdeka'),
            'picture'           => '',
            'status'            => 1,
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Dr. I Nyoman Suardana, M.Si.'),
            'username'          => strtolower('dosen01'),
            'email'             => 'dosen01@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 3,
            'tmptlahir'         => ucwords('jakarta'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '089123498319',
            'alamat'            => ucwords('Jl. Pusaka'),
            'picture'           => '',
            'status'            => 1,
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Dr. Dewa Bagus Sanjaya, M.Si.'),
            'username'          => strtolower('dosen02'),
            'email'             => 'dosen02@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 3,
            'tmptlahir'         => ucwords('bandung'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '089123498222',
            'alamat'            => ucwords('Jl. Harmonis'),
            'picture'           => '',
            'status'            => 1,
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Admin 01'),
            'username'          => strtolower('admin01'),
            'email'             => 'admin01@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 2,
            'tmptlahir'         => ucwords('semarang'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '089123498111',
            'alamat'            => ucwords('Jl. Pelabuhan'),
            'picture'           => '',
            'status'            => 1,
        ]);
    }
}
