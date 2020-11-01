<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        // Validation
        // Save the post
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        // If you have any error trying save the date use Carbon::parse(***) method;
        $post->published_at = $request->published_at;
        $post->category_id = $request->category;
        $post->save();
        // Tags
        $post->tags()->attach($request->get('tags'));
        return back()->with('flash', 'Tu publicación ha sido creada');
    }
}
