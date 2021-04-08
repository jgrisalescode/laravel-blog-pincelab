<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        $title = $this->faker->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(7),
            'body' => $this->faker->paragraph(),
            'category_id' => $this->faker->numberBetween(1,3),
            'user_id' => rand(1,2),
            'published_at' => Carbon::now()->subDays($this->faker->numberBetween(1,4)),
        ];
    }
}
