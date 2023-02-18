<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'firstname' => 'Administrador',
                'lastname' => 'Principal',
                'email' => 'admin@idx.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}
