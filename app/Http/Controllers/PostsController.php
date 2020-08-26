<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * Posts feed
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $following = Auth::user()->following()->pluck('profiles.user_id');
        $following->push([Auth::user()->id =>Auth::user()->id]);  // Add users own posts to the feed
        $posts = Post::whereIn('user_id', $following)->with('user')->latest()->paginate(5);
        $likes = Auth::user()->liked_posts()->pluck('post_id');  // TODO: Optimise this, inefficient to pass all liked posts

        return view('posts.index', compact('posts', 'likes'));

    }

    /**
     * Create new post
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * View a post
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        $follows = (Auth::user()) ? Auth::user()->following->contains($post->user_id) : false;
        $likes = Auth::user()->liked_posts()->pluck('post_id');  // TODO: Optimise this, inefficient to pass all liked posts
        return view('posts.show', compact('post', 'likes', 'follows'));
    }


    /**
     * Store created post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = request()->validate([
            'caption' => ['required', 'string'],
            'image' => ['required', 'mimes:jpeg,png']
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200)->save();  // Resize image

        Auth::user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect()->route('profile.index');
    }
}
