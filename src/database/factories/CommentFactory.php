<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $postsIDs = DB::table('posts')->pluck('id');

        return [
            'post_id' => $this->faker->randomElement($postsIDs),
            'content' => $this->faker->text(random_int(50, 300)),
            'author_name' => $this->faker->name(),
            'created_at' => Carbon::now()->addSeconds(random_int(1, 100)),
        ];
    }
}
