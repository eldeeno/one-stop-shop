<?php

namespace App\Modules\Product\Database\Factories;

use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'price_in_cents' => random_int(100, 10000),
            'stock' => random_int(1, 10),
        ];
    }
}
