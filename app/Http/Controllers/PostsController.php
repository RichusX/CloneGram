<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts/create');
    }

    public function show()
    {
        return view('posts/show');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => ['required', 'string'],
            'image' => ['required', 'mimes:jpeg,png']
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        Auth::user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect()->route('profile.index');

    }
}
