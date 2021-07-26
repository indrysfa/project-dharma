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
            'status_id'     => 1,
            'name'          => ucwords('Admin 01'),
            'username'      => strtolower('admin'),
            'email'         => 'admin@mail.com',
            'password'      => Hash::make('12345678'),
            'role'          => 'admin',
            'tmptlahir'     => ucwords('jakarta'),
            'tgl_lahir'     => '2021-09-01',
            'no_telepon'    => '08912345678',
            'alamat'        => ucwords('Jl. Merdeka'),
            'image'        => 'abc',
        ]);
    }
}
