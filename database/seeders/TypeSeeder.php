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
            ["name" => "Dosen"],
            ["name" => "Mahasiswa"],
            ["name" => "Tenaga Pendidikan"],
            ["name" => "Tamu"],
        ];

        foreach ($data as $value) {
            Type::create($value);
        }
    }
}
