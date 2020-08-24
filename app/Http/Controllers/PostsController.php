<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => ['required', 'string'],
            'image' => ['required', 'mimes:jpeg,png']
        ]);


        $imagePath = request('image')->store('uploads', 'public');
        Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200)->save();


        Auth::user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect()->route('profile.index');

    }
}
