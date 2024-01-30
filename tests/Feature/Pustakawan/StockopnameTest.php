<?php

namespace Tests\Feature\pustakawan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StockopnameTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_stockopname()
    {
        $response = $this->get('/api/stockopname/9b0f7935-db82-4656-87dc-abe75843fd10');
        $response->assertStatus(200);
    }
}
