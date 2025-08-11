<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\Request;

class BountyRequestController extends Controller
{
    public function index()
    {
        $requests = Request::all();
        return view('bounty-request', compact('requests'));
    }

    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'beatmap_url'   => 'required|url|max:255',
            'difficulty'    => 'required|string|max:255',
            'required_mods' => 'nullable|string|max:255',
            'description'   => 'nullable|string|max:1000',
            'donators'      => 'nullable|string|max:255',
            'reward'        => 'required|string|max:255',
            'contact_info'  => 'required|string|max:255',
        ]);

        Request::create($validated);

        return redirect()->route('bounty-request')
        ->with('success', 'Bounty submitted successfully!')
        ->with('submitted', true);
    }
}

