<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'link' => $this->faker->url(),
            'amount_of_upvotes' => $this->faker->numberBetween(0, 100),
            'author_name' => $this->faker->name(),
            'created_at' => Carbon::now()->addSeconds(random_int(1, 100)),
        ];
    }
}
