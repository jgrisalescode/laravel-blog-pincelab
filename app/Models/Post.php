<?php

namespace App\Models;

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
}
