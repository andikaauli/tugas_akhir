<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Biblio;
use Illuminate\Database\Seeder;
use Database\Seeders\TypeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\BookStatusSeeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TypeSeeder::class,
            BookStatusSeeder::class,
            BiblioSeeder::class,
        ]);
    }
}
