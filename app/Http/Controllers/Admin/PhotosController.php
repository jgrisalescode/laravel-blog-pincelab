<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Photo $photo)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:2048',

        ]);
        $photo = request()->file('photo');
    }
}
