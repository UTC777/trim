<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'wecodelaravel@gmail.com',
                'password'           => '$2y$10$YZHHXNro/c.O5cDQlof/uuzye6gTX28CEp7J38ckxs6HBA.1CrNAK',
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2024-01-17 20:10:23',
                'verification_token' => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'Tapas',
                'email'              => 'tpsvishwas78@gmail.com',
                'password'           => '$2y$10$uDHddo5WsEprvOlkx52X0OI8h1PVJSpAzzWz.IGidiJ7EXF8wwEA6',
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2024-01-17 20:10:23',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
