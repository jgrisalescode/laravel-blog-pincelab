<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'iframe',
        'excerpt',
        'published_at',
        'category_id',
    ];

    // Converting publised_at as carbon instance for manage dates
    protected $dates = ['published_at'];

    public function category(): BelongsTo // $post->category->name
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * scopePublished we are goint to use published() in a query
     */

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', Carbon::now())
                    ->orderBy('published_at', 'desc');
    }

    /**
     * Ovewrite for get the post by title not for id (Slug)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
                                            ? $category
                                            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags){
        $tagsIds = collect($tags)->map(function ($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
        return $this->tags()->attach($tagsIds);
    }
}
