<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClaimedBounty;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($name)
    {
        $user = User::where('name', $name)
                    ->with(['claimedBounties.bounty'])
                    ->firstOrFail();

        return view('user.profile', compact('user'));
    }
}
