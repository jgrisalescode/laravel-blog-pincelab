<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraph(),
            'category_id' => $this->faker->numberBetween(1,3),
            'published_at' => Carbon::now()->subDays($this->faker->numberBetween(1,4)),
        ];
    }
}
