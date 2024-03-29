<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "admin",
            "username" => "adminperpusft",
            "password" => Hash::make("adminperpusft"),
            "email" => "adminperpus@gmail.com"
        ]);
        User::create([
            "name" => "abimanyu",
            "username" => "abimanyu",
            "password" => Hash::make("abimanyu"),
            "email" => "abndung@gmail.com"
        ]);
    }
}
