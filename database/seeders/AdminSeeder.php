<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'diskominfo@paserkab.go.id'
            ],
            [
                'name' => 'Admin Diskominfo',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ]
        );
    }
}