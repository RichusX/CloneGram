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
        if (Auth::user()){
            $follows = Auth::user()->following->contains($post->user_id);
        } else {
            $follows = false;
        }
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

    /**
     * Show post edit form
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update post using form data
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post)
    {
        $data = request()->validate([
            'caption' => ['required', 'string'],
        ]);

        $post->update($data);

        return redirect()->route('post.show', ['post' => $post->id]);
    }


    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('index');
    }


}
