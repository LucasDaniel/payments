<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTransferTest extends TestCase
{
    public function test_the_value_field_must_be_a_number(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => "a", 'payer' => 2, 'payee' => 3]);
 
        $response->assertSeeText("The value field must be a number. - 0",false);
    }

    public function test_the_payer_field_must_be_a_number(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => "a", 'payee' => 3]);
 
        $response->assertSeeText("The payer field must be an integer. - 0",false);
    }

    public function test_the_payee_field_must_be_a_number(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => 2, 'payee' => "a"]);
 
        $response->assertSeeText("The payee field must be an integer. - 0",false);
    }

    public function test_dont_have_money(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 1000000, 'payer' => 2, 'payee' => 3]);
 
        $response->assertSeeText("Don't have money! - 506",false);
    }

    public function test_store_dont_send_money_to_anyone(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => 3, 'payee' => 2]);
 
        $response->assertSeeText("STORE don't send money to anyone! - 507",false);
    }

    public function test_the_value_field_must_be_highter_than_zero(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 0, 'payer' => 2, 'payee' => 3]);
 
        $response->assertSeeText('The value field must be at least 0.01. - 0',false);
    }
    
    public function test_the_value_field_is_required(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['payer' => 2, 'payee' => 3]);
 
        $response->assertSeeText('The value field is required. - 0',false);
    }

    public function test_the_payer_field_is_required(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payee' => 3]);
 
        $response->assertSeeText('The payer field is required. - 0',false);
    }

    public function test_the_payee_field_is_required(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => 999999]);
 
        $response->assertSeeText('The payee field is required. - 0',false);
    }

    public function test_send_payer_dont_exists(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => 999999, 'payee' => 3]);
 
        $response->assertSeeText('Error on get user payer! - 502',false);
    }

    public function test_send_payee_dont_exists(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => 2, 'payee' => 999999]);
 
        $response->assertSeeText('Error on get user payee! - 510',false);
    }
}
