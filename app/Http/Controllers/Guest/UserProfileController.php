<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)->firstOrFail();

        return view('user.profile', compact('user'));
    }
}
