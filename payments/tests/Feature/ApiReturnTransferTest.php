<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiReturnTransferTest extends TestCase
{
    public function test_id_transfer_dont_exists(): void
    {
        $response = $this->postJson('/api/transfer/returnTransfer', ['id_transfer' => 999999]);
 
        $response->assertSeeText('Error on get transfer to return values! - 508',false);
    }

    public function test_transfer_is_not_finished_to_return_values(): void
    {
        $response = $this->postJson('/api/transfer/returnTransfer', ['id_transfer' => 1]);
 
        $response->assertSeeText('Tranfer is not finished to return values! - 509',false);
    }
}
