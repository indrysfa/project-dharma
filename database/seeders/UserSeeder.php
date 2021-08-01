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
            'name'              => ucwords('Admin 01'),
            'username'          => strtolower('admin'),
            'email'             => 'admin@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 1,
            'tmptlahir'         => ucwords('jakarta'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '08912345678',
            'alamat'            => ucwords('Jl. Merdeka'),
            'picture'           => '',
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Dosen 01'),
            'username'          => strtolower('dosen01'),
            'email'             => 'dosen1@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 3,
            'tmptlahir'         => ucwords('jakarta'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '089123498319',
            'alamat'            => ucwords('Jl. Pusaka'),
            'picture'           => '',
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Dosen 02'),
            'username'          => strtolower('dosen02'),
            'email'             => 'dosen2@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 3,
            'tmptlahir'         => ucwords('bandung'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '089123498222',
            'alamat'            => ucwords('Jl. Harmonis'),
            'picture'           => '',
        ]);

        DB::table('users')->insert([
            'name'              => ucwords('Admin 01'),
            'username'          => strtolower('admin01'),
            'email'             => 'admin1@mail.com',
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make('12345678'),
            'role_id'           => 2,
            'tmptlahir'         => ucwords('semarang'),
            'tgl_lahir'         => '2021-09-01',
            'no_telepon'        => '089123498111',
            'alamat'            => ucwords('Jl. Pelabuhan'),
            'picture'           => '',
        ]);
    }
}
