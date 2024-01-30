<?php

namespace Tests\Feature\Pengunjung;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // public function test_pengunjung_dapat_melakukan_absensi()
    // {
    //     $response = $this->post('/api/visitor/add', [
    //         'name' => 'Abimanyu',
    //         'institution' => 'Teknik Komputer',
    //         'jenis_id' => '1',
    //     ]);

    //     $response->assertStatus(200);
    // }
    // public function test_pengunjung_gagal_absen_jika_ada_kolom_kosong()
    // {
    //     $response = $this->post('/api/visitor/add', [
    //         'name' => '',
    //         'institution' => '',
    //         'jenis_id' => '',
    //     ]);

    //     $response->assertStatus(422);
    // }
}
