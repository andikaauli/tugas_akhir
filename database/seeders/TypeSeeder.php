<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["id" => "1","name" => "Dosen"],
            ["id" => "2","name" => "Mahasiswa"],
            ["id" => "3","name" => "Tenaga Pendidikan"],
            ["id" => "4","name" => "Tamu"],
        ];

        foreach ($data as $value) {
            Type::create($value);
        }
    }
}
