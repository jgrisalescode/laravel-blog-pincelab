<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:4096',

        ]);

        $post->photos()->create([
            'url' => request()->file('photo')->store('posts','public'),
        ]);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return back()->with('flash', 'Foto eliminada');
    }
}
