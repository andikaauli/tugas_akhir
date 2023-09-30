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
            ["id" => "1","name" => "Dipinjam"],
            ["id" => "2","name" => "Tersedia"],
            ["id" => "3","name" => "Hilang"],
        ];

        foreach ($data as $value) {
            BookStatus::create($value);
        }
    }
}
