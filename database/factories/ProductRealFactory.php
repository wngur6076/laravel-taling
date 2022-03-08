<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductRealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stockQuantity = $this->faker->randomElement([0, $this->faker->numberBetween(1, 100)]);

        return [
            'option_1_type' => 'SIZE',
            'option_2_type' => 'COLOR',
            'is_sold_out' => $stockQuantity === 0,
            'add_price' => $this->faker->numberBetween(500, 10000),
            'stock_quantity' => $stockQuantity,
        ];
    }
}
