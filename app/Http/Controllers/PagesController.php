<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function home()
    {
        $posts = Post::published()->paginate(5);

        return view('welcome', compact('posts'));
    }
}
