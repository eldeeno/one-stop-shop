<?php

namespace App\Modules\Order\Test\Http\Controllers;

use App\Modules\Order\Models\Order;
use App\Modules\Order\Test\OrderTestCase;
use App\Modules\Payment\PayBuddy;
use App\Modules\Product\Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use DatabaseMigrations;

    #[Test]
    public function it_successfully_creates_an_order(): void
    {
        $user = UserFactory::new()->create();
        $products = ProductFactory::new()->count(2)->create(
            new Sequence(
                ['name' => 'Very expensive air fryer', 'price_in_cents' => 10000, 'stock' => 10],
                ['name' => 'Macbook Pro M3', 'price_in_cents' => 50000, 'stock' => 10]
            )
        );

        $paymentToken = PayBuddy::validToken();

        $response = $this->actingAs($user)
            ->post(route('order::checkout', [
                'payment_token' => $paymentToken,
                'products' => [
                    ['id' => $products->first()->id, 'quantity' => 1],
                    ['id' => $products->last()->id, 'quantity' => 1],
                ],
            ]));

        $response->assertStatus(201);

        $order = Order::query()->latest('id')->first();

        // Order
        $this->assertTrue($order->user->is($user));
        $this->assertEquals(60000, $order->total_in_cents);
        $this->assertEquals('paid', $order->status);
        $this->assertEquals('PayBuddy', $order->payment_gateway);
        $this->assertEquals('PayBuddy', strlen($order->payment_id));

        // Order Lines
        $this->assertCount(2, $order->lines);

        foreach ($products as $product) {
            /** @var App\Modules\Order\Models\OrderLine $orderLine */
            $orderLine = $order->lines->where('product_id', $product->id)->first();

            $this->assertEquals($product->price_in_cents, $orderLine->product_price_in_cents);
            $this->assertEquals(1, $orderLine->quantity);
        }

    }

    #[Test]
    public function it_fails_with_an_invalid_token(): void
    {
        $this->markTestSkipped();

        $user = UserFactory::new()->create();
        $product = ProductFactory::new()->create();
        $paymentToken = PayBuddySdk::invalidToken();

        $response = $this->actingAs($user)
            ->postJson(route('order::checkout', [
                'payment_token' => $paymentToken,
                'products' => [
                    ['id' => $product->id, 'quantity' => 1],
                ],
            ]));

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['payment_token']);

        $this->assertEquals(0, Order::query()->count());
    }
}
