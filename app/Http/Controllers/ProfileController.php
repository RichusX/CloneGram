<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Show the current user profile.
     *
     */
    public function index()
    {
        // Return their own profile
        return view('profiles.show', [
            'user' => Auth::user(),
        ]);

    }


    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profiles.show', [
            'user' => $user,
        ]);
    }

    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $this->authorize('update', $user->profile);
        return view('profiles.edit', [
            'user' => $user,
        ]);
    }

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
