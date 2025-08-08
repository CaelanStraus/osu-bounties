<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
