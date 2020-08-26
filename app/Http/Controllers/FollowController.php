<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Toggle following status on user profile
     *
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return Auth::user()->following()->toggle($user->profile);
    }
}
