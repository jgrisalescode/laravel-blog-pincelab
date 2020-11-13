<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $request->validate([
            'title' => 'required',
        ]);

        $post = Post::create([
            'title' => $request->get('title'),
            'slug' => Str::slug($request->get('title')),
            ]);

        return redirect()->route('admin.posts.edit', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // public function store(Request $request)
    // {
    //     // Validation
    //     $request->validate([
    //         'title' => 'required',
    //         'body' => 'required',
    //         'category' => 'required',
    //         'excerpt' => 'required',
    //         'tags' => 'required'
    //     ]);
    //     // Save the post
    //     $post = new Post();
    //     $post->title = $request->title;
    //     $post->slug = Str::slug($post->title);
    //     $post->body = $request->get('body');
    //     $post->excerpt = $request->get('excerpt');
    //     // If you have any error trying save the date use Carbon::parse(***) method;
    //     $post->published_at = $request->has('published_at') ? $request->published_at : null;
    //     $post->category_id = $request->category;
    //     $post->save();
    //     // Tags
    //     $post->tags()->attach($request->get('tags'));
    //     return back()->with('flash', 'Tu publicación ha sido creada');
    // }
}
