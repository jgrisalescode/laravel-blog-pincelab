<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
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
        $posts = auth()->user()->posts;
        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Post);
        $this->validate($request, ['title' => 'required|min:3']);
        // $post = Post::create($request->only('title'));
        $post = Post::create([
            'title' => $request->get('title'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('admin.posts.edit', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        // We can use update method if the request matches with fillable in model
        $post->update($request->all());
        $post->syncTags($request->get('tags'));
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'La publicación ha sido guardada');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index', $post)->with('flash', 'La publicación ha sido eliminada');
    }
}
