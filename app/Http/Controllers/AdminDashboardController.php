<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('usertype')) {
            $query->where('usertype', $request->usertype);
        }

        $users = $query->get();

        return view('admin.dashboard', compact('users'));
    }
}
