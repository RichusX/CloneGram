<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Redirect to the profile of currently logged in user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Return their own profile
        return redirect()->route('profile.show', ['username' => Auth::user()->username]);

    }

    /**
     * View user profile
     *
     * @param $username
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follows = (Auth::user()) ? Auth::user()->following->contains($user->id) : false;

        // Gather user profile stats (post count, followers and following) and cache them for 30 sec
        $profileStats = [
            'posts' => Cache::remember('count.posts.'.$user->id, 30, function () use ($user) {
                return $user->posts->count();
            }),
            'followers' => Cache::remember('count.followers.'.$user->id, 30, function () use ($user) {
                return $user->profile->followers->count();
            }),
            'following' => Cache::remember('count.following.'.$user->id, 30, function () use ($user) {
                return $user->following->count();
            }),
        ];

        return view('profiles.show', compact('user', 'follows', 'profileStats'));
    }

    /**
     * Edit profile
     *
     * @param $username
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    /**
     * Update profile with the submitted data
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($username)
    {
        $data = request()->validate([
            'description' => ['required', 'string'],
            'url' => ['string', 'URL'],
            'image' => ['image']
        ]);

        if (request('image')){
            $imagePath = request('image')->store('profile', 'public');
            Image::make(public_path("storage/{$imagePath}"))->fit(800)->save();

            Auth::user()->profile->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
        } else {
            Auth::user()->profile->update($data);
        }

        return redirect()->route('profile.index');
    }
}
