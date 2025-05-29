<?php

namespace App\Modules\Product\Test;

use App\Modules\Product\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_it_creates_a_product()
    {
        $product = new Product();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertTrue(true);
    }
}
