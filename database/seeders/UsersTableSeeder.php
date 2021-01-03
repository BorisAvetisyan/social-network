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
        $int = 10000;
        for ($i = 0; $i < $int; $i++) {
            $string = $this->generateRandomString(6);
            User::create([
                    'name' => 'name_'.$string,
                    'surname' => 'surname_'.$string,
                    'email' => $string.'@'.$string.'.com',
                    'password' => Hash::make('password')
                ]
            );
        }
    }

    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
