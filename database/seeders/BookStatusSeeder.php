<?php

namespace Database\Seeders;

use App\Models\BookStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Dipinjam"],
            ["name" => "Tersedia"],
            ["name" => "Hilang"],
        ];

        foreach ($data as $value) {
            BookStatus::create($value);
        }
    }
}
