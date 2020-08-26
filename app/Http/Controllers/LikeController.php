<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Toggle like on post
     *
     * @param Post $post
     * @return mixed
     */
    public function store(Post $post)
    {
        return Auth::user()->liked_posts()->toggle($post);
    }
}
