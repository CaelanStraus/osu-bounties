<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\Request;
use App\Models\Bounty;

class AdminRequestsController extends Controller
{
    public function index()
    {
        $requests = Request::all();
        $bounties = Bounty::all();
        return view('admin.requests', compact('bounties', 'requests'));
    }

    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'beatmap_title' => 'required|string|max:255',
            'beatmap_url'   => 'required|url|max:255',
            'artist'        => 'required|string|max:255',
            'difficulty'    => 'required|string|max:255',
            'required_mods' => 'nullable|string|max:255',
            'beatmap_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description'   => 'nullable|string|max:1000',
            'donators'      => 'nullable|string|max:255',
            'reward'        => 'required|string|max:255',
        ]);

        if ($request->hasFile('beatmap_image')) {
            $file = $request->file('beatmap_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/beatmaps'), $filename);
            $validated['beatmap_image'] = $filename;
        }

        Bounty::create($validated);

        return redirect()->route('admin.requests')
            ->with('success', 'Bounty added successfully!')
            ->with('submitted', true);
    }

    public function destroy($id)
        {
            $bounty = Bounty::findOrFail($id);

            if ($bounty->beatmap_image && file_exists(public_path('images/beatmaps/' . $bounty->beatmap_image))) {
                unlink(public_path('images/beatmaps/' . $bounty->beatmap_image));
            }

            $bounty->delete();

            return redirect()->route('admin.requests')
                ->with('success', 'Bounty removed successfully!');
        }
}
