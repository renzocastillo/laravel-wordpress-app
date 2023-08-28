<?php

namespace Tests\Feature\Customer;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExportToWordPressTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_customer_can_be_exported_to_wordpress(): void
    {
        $user = User::factory()->create();
        $customer = Customer::factory()->create();
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->postJson( '/customer_create_user', ['customerId'=> $customer->id] );
        $response->assertStatus(200);
    }
}
