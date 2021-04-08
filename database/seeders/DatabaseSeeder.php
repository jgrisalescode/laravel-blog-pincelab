<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        User::factory()->create();
        User::create(
            [
                'name' => 'Tester',
                'email' => 'tester@blog.com',
                'email_verified_at' => now(),
                'password' => bcrypt(12345678), // 12345678
                'remember_token' => Str::random(10),
            ]
        );
        Category::factory(4)->create();
        Post::factory(5)->create();
        Tag::factory(5)->create();

        // Post - Tags seeder
        $tags = Tag::all();
        $posts = Post::all();

        foreach ($posts as $post){
            $tagNumber = rand(1, 4);
            $newTags = $tags->slice(0, $tagNumber);
            $post->tags()->attach($newTags);
        }
    }
}
