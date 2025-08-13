<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function destroy(User $user)
    {
        if ($user->usertype === 'admin') {
            return redirect()->back()->with('error', 'Cannot remove admin users.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User removed successfully.');
    }

    public function toggleRole(User $user)
    {
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        if ($user->usertype === 'admin') {
            $user->usertype = 'user';
            $message = 'User demoted to regular user.';
        } else {
            $user->usertype = 'admin';
            $message = 'User promoted to admin.';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }
}
