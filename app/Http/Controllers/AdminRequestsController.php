<?php

namespace App\Http\Controllers;

use App\Models\Request;

class AdminRequestsController extends Controller
{
    public function index()
    {
        $requests = Request::all();
        return view('admin.requests', compact('requests'));
    }
}
