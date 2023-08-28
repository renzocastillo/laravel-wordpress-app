<?php

namespace Tests\Feature\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test to validate if user registration can be rendered
     */
    public function test_render_customer_registration(): void
    {
        $response = $this->get('/customer/create');

        $response->assertStatus(200);
    }

    /**
     * A basic test to validate if customer can be registered
     */
    public function test_customer_can_be_registered(): void {
        $customer = Customer::factory()->make();
        $response = $this->post( '/customer', $customer->toArray() );
        $response->assertStatus(302);
        $response->assertRedirect('/customer/create');
    }
}
