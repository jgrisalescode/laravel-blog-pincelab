<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function home()
    {
        // Using query scope see the model in the scopePublished method
        // $posts = Post::published()->get();

        // The queryScope is not working form model
        $posts = Post::published()->paginate(1);

        return view('welcome', compact('posts'));
    }
}
