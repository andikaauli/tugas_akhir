<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Biblio;
use App\Models\Member;
use App\Models\CollType;
use App\Models\Eksemplar;
use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BiblioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=fake('id_ID');
        for ($i=0; $i < 10; $i++) {
            $biblio=Biblio::create([
            'title' => $faker->word(),
            'author_id' => Author::create([
                'title'=> $faker->word(),
                'born_date'=> $faker->date(),
            ])->id,
            'responsibility' => $faker->word(),
            'edition' => $faker->word(),
            'spec_detail' => $faker->word(),
            'coll_type_id' => CollType::create([
                'title'=> $faker->word(),
            ])->id,
            'gmd' => $faker->word(),
            'content_type' => $faker->word(),
            'media_type' => $faker->word(),
            'carrier_type' => $faker->word(),
            'date' => $faker->date(),
            'isbnissn' => $faker->randomNumber(),
            'publisher_id' => Publisher::create([
                'title'=> $faker->word(),
            ])->id,
            'place' => $faker->word(),
            'description' => $faker->word(),
            'title_series' => $faker->word(),
            'classification' => $faker->word(),
            'call_number' => $faker->randomNumber(),
            'language' => $faker->word(),
            'abstract' => $faker->word(),
            'image' => $faker->imageUrl(),
            ]);
        }
        $faker=fake('id_ID');
            for ($i=0; $i < 20; $i++) {
                $eksemplar=Eksemplar::create([
                'item_code' => $faker->randomNumber(),
                'rfid_code' => $faker->randomNumber(),
                'order_number' => $faker->randomNumber(),
                'order_date' => $faker->date(),
                'receipt_date' => $faker->date(),
                'agent' => $faker->word(),
                'source' => $faker->randomElement(['Beli','Hadiah']),
                'invoice' => $faker->word(),
                'price' => $faker->randomNumber(),
                'book_status_id' => $faker->randomElement([1,2,3]),
                'biblio_id' => $biblio->id,
                // 'biblio_id' => Biblio::create([
                //     'title'=> $faker->word(),
                // ])->id,
                ]);
            }

            $faker=fake('id_ID');
            for ($i=0; $i < 20; $i++) {
                $member=Member::create([
                'name' => $faker->word(),
                'nim' => $faker->randomNumber(),
                'gender' => $faker->randomElement(['Laki-laki','Perempuan']),
                'birth_date' => $faker->date(),
                'address' => $faker->word(),
                'email' => $faker->email(),
                'instituion' => $faker->word(),
                'image' => $faker->imageUrl(),
                'phone' => $faker->phoneNumber(),
                ]);
            }

    }
}
