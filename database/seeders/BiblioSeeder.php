<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Biblio;
use App\Models\Member;
use App\Models\CollType;
use App\Models\Eksemplar;
use App\Models\Publisher;
use Illuminate\Support\Str;
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
        for ($i=0; $i < 20; $i++) {
            $biblio=Biblio::create([
            'title' => $faker->word(),
            'author_id' => Author::create([
                'title'=> $faker->unique()->word(),
                'born_date'=> $faker->randomNumber(),
            ])->id,
            'responsibility' => $faker->word(),
            'edition' => $faker->word(),
            'spec_detail' => $faker->word(),
            'coll_type_id' => CollType::create([
                'title'=> $faker->unique()->word(),
            ])->id,
            'gmd' => $faker->word(),
            'content_type' => $faker->word(),
            'media_type' => $faker->word(),
            'carrier_type' => $faker->word(),
            'date' => $faker->date(),
            'isbnissn' => $faker->unique()->randomNumber(),
            'publisher_id' => Publisher::create([
                'title'=> $faker->unique()->word(),
            ])->id,
            'place' => $faker->word(),
            'description' => $faker->word(),
            'title_series' => $faker->word(),
            'classification' => $faker->word(),
            'call_number' => $faker->unique()->randomNumber(),
            'language' => $faker->word(),
            'abstract' => $faker->word(),
            'image' => $faker->imageUrl(),
            ]);
        }
            // $faker=fake('id_ID');
            // for ($i=0; $i < 10000; $i++) {
            //     $eksemplar=Eksemplar::create([
            //     'item_code' => $faker->unique()->randomNumber(),
            //     'rfid_code' => $faker->unique()->randomNumber(),
            //     'order_number' => $faker->randomNumber(),
            //     'order_date' => $faker->date(),
            //     'receipt_date' => $faker->date(),
            //     'agent' => $faker->word(),
            //     'source' => $faker->randomElement(['Beli','Hadiah']),
            //     'invoice' => $faker->word(),
            //     'price' => $faker->randomNumber(),
            //     'book_status_id' => $faker->randomElement([2,3]),
            //     'biblio_id' => $biblio->id,
            //     ]);
            // }
            $faker=fake('id_ID');
            for ($i=0; $i < 6000; $i++) {
                $data[]=[
                    'id' => Str::uuid()->toString(),
                    'item_code' => $faker->unique()->randomNumber(),
                    'rfid_code' => $faker->unique()->randomNumber(),
                    'order_number' => $faker->randomNumber(),
                    'order_date' => $faker->date(),
                    'receipt_date' => $faker->date(),
                    'agent' => $faker->word(),
                    'source' => $faker->randomElement(['Beli','Hadiah']),
                    'invoice' => $faker->word(),
                    'price' => $faker->randomNumber(),
                    'book_status_id' => $faker->randomElement([2]),
                    'biblio_id' => $biblio->id,
                ];
            }
            foreach (array_chunk($data, 1000) as $item) {
                Eksemplar::insert($item);
            }


                    $faker=fake('id_ID');
                    for ($i=0; $i < 20; $i++) {
                        $member=Member::create([
                        'name' => $faker->word(),
                        'nim' => $faker->unique()->randomNumber(),
                        'gender' => $faker->randomElement(['Laki-laki','Perempuan']),
                        'birth_date' => $faker->date(),
                        'address' => $faker->word(),
                        'email' => $faker->unique()->email(),
                        'institution' => $faker->word(),
                        'image' => $faker->unique()->imageUrl(),
                        'phone' => $faker->phoneNumber(),
                        ]);
                    }

    }
}
