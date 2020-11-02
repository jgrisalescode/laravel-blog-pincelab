<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{
    public function home()
    {
        // Using query scope see the model in the scopePublished method
        $posts = Post::published()->get();
        return view('welcome', compact('posts'));
    }
}
