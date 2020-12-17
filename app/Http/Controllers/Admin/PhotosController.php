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
        $photo = request()->file('photo')->store('public');
        $photoUrl = Storage::url($photo);

        Photo::create([
            'url' => $photoUrl,
            'post_id' => $post->id,
        ]);
    }
}
