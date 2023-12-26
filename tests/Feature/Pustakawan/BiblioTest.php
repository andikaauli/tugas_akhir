<?php

namespace Tests\Feature\pustakawan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BiblioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_pustakawan_dapat_melihat_daftar_bibliografi()
    // {
    //     $response = $this->get('/api/biblio');
    //     $response->assertStatus(200);
    // }
    // public function test_pustakawan_dapat_melihat_detail_bibliografi()
    // {
    //     $response = $this->get('/api/biblio/9a9f35c3-5469-4cc6-8dfa-3c36077612e6');
    //     $response->assertStatus(200);
    // }
    // public function test_pustakawan_dapat_menambah_bibliografi_baru()
    // {
    //     $faker=fake('id_ID');
    //     $response = $this->post('/api/biblio/add', [
    //         'title' => 'unittest',
    //         'author_id' => '1',
    //         'responsibility' => 'unittest',
    //         'edition' => 'unittest',
    //         'spec_detail' => 'unittest',
    //         'coll_type_id' => '1',
    //         'gmd' => 'unittest',
    //         'content_type' => 'unittest',
    //         'media_type' => 'unittest',
    //         'carrier_type' => 'unittest',
    //         'date' => '2022-01-01',
    //         'isbnissn' => $faker->randomNumber(), //unique
    //         'publisher_id' => '1',
    //         'place' => 'unittest',
    //         'description' => 'unittest',
    //         'title_series' => 'unittest',
    //         'classification' => 'unittest',
    //         'call_number' => $faker->randomNumber(), //unique
    //         'language' => 'unittest',
    //         'abstract' => 'unittest',
    //         'image' => ''
    //     ]);

    //     $response->assertStatus(200);
    // }
    // public function test_pustakawan_gagal_menambah_bibliografi_baru_jika_tidak_sesuai_requirements()
    // {
    //     $faker=fake('id_ID');
    //     $response = $this->post('/api/biblio/add', [
    //         'title' => 'unittest',
    //     ]);

    //     $response->assertStatus(422);
    // }
    // public function test_pustakawan_dapat_edit_bibliografi()
    // {
    //     $faker=fake('id_ID');
    //     $response = $this->post('/api/biblio/edit/9a9f5112-a94e-4ce1-a3c1-36c6542f1f3e', [
    //         'title' => 'unittest',
    //         'author_id' => '1',
    //         'responsibility' => 'unittest',
    //         'edition' => 'unittest',
    //         'spec_detail' => 'unittest',
    //         'coll_type_id' => '1',
    //         'gmd' => 'unittest',
    //         'content_type' => 'unittest',
    //         'media_type' => 'unittest',
    //         'carrier_type' => 'unittest',
    //         'date' => '2022-01-01',
    //         'isbnissn' => $faker->randomNumber(), //unique
    //         'publisher_id' => '1',
    //         'place' => 'unittest',
    //         'description' => 'unittest',
    //         'title_series' => 'unittest',
    //         'classification' => 'unittest',
    //         'call_number' => $faker->randomNumber(), //unique
    //         'language' => 'unittest',
    //         'abstract' => 'unittest',
    //         'image' => ''
    //     ]);
    //     $response->assertStatus(200);
    // }

    // public function test_pustakawan_gagal_edit_bibliografi_baru_jika_tidak_sesuai_requirements()
    // {
    //     $response = $this->post('/api/biblio/edit/9a9f5112-a94e-4ce1-a3c1-36c6542f1f3e', [
    //         'title' => 'unittest',
    //     ]);

    //     $response->assertStatus(422);
    // }

    // public function test_pustakawan_dapat_menghapus_bibliografi()
    // {
    //     $response = $this->delete('/api/author/destroy/9a9f4ff5-850d-4850-93a9-96a2403d6e0f');
    //     $response->assertStatus(200);
    // }
}
