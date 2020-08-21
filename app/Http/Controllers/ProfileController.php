<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the current user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Check if the current user is authenticated
        if (Auth::check()) {
            // Return their own profile
            return view('profiles.show', [
                'user' => Auth::user(),
            ]);
        } else {
            // If guest, redirect to login page
            return view('auth.login');
        }
    }


    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profiles.show', [
            'user' => $user,
        ]);
    }
}
