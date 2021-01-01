<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
            ]
        );

        User::create([
            'name' => 'boris',
            'surname' => 'avetisyan',
            'email' => 'boris@boris.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'armen',
            'surname' => 'armenakyan',
            'email' => 'armen@armen.com',
            'password' => Hash::make('password')
        ]);

    }
}
