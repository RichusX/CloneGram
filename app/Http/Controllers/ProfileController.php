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
}
