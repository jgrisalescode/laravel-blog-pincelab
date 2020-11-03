<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Converting publised_at as carbon instance for manage dates
    protected $dates = ['published_at'];

    public function category() // $post->category->name
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * scopePublished we are goint to use published() in a query
     */

    public function scopePublished($query)
    {
        $posts = Post::all()
                        ->whereNotNull('published_at')
                        ->where('published_at', '<=', Carbon::now())
                        ->sortByDesc('published_at');
    }

    /**
     * Ovewrite for get the post by title not for id (Slug)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
