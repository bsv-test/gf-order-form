<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testStore(): void
    {
        $user = factory(\App\Models\User::class)->raw();
        $order = factory(\App\Models\Order::class)->raw();
        $response = $this->postJson(route('orders.store'), compact('user', 'order'));
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $user);
        $this->assertDatabaseHas('orders', $order);
    }

    public function testStoreRequestWithInvalidData(): void
    {
        $this->postJson(route('orders.store'))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['user.name', 'user.phone']);
    }
}
