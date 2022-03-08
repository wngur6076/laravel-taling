<?php

namespace Database\Factories;

use App\Facades\ProductNumber;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $files = collect(Storage::disk('public')->files('uploads/product/2022/02/01'))
        ->reject(fn ($file) => $file === 'uploads/product/.DS_Store')
        ->values()
        ->toArray();

        return [
            'name' => $this->faker->name(),
            'serial_number' => ProductNumber::generate(),
            'display_name' => $this->faker->name(),
            'description' => $this->faker->text(100),
            'price' => $this->faker->numberBetween(10000, 50000),
            'sale_price' => $this->faker->numberBetween(1000, 9999),
            'review_point' => $this->faker->randomFloat(1, 0, 5),
            'thumb_img_path' => $this->faker->randomElement($files),
        ];
    }
}
