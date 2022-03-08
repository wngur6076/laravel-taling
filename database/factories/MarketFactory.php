<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->domainWord(),
            'site_url' => $this->faker->url(),
            'email' => $this->faker->email(),
            'review_point' => $this->faker->randomFloat(1, 0, 5),
            'description' => $this->faker->text(100),
            'user_id' => function () {
                return User::factory()->create()->id;
            }
        ];
    }
}
