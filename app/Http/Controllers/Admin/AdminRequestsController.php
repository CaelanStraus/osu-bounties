<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use App\Models\Request as UserRequest;
use App\Models\Bounty;

class AdminRequestsController extends Controller
{
    public function index(HttpRequest $request)
    {
        $requests = UserRequest::all();

        $query = Bounty::query();

        if ($request->filled('title')) {
            $query->where('beatmap_title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('artist')) {
            $query->where('artist', 'like', '%' . $request->artist . '%');
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', 'like', '%' . $request->difficulty . '%');
        }

        $bounties = $query->get();

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

    public function destroyRequest($id)
    {
        $request = UserRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.requests')
            ->with('success', 'Request removed successfully!');
    }

    public function edit($id)
    {
        $bounty = Bounty::findOrFail($id);
        return view('admin.edit-bounty', compact('bounty'));
    }

    public function update(HttpRequest $request, $id)
    {
        $bounty = Bounty::findOrFail($id);

        $request->validate([
            'beatmap_title'   => 'required|string|max:255',
            'beatmap_url'     => 'required|url|max:255',
            'artist'          => 'required|string|max:255',
            'difficulty'      => 'required|string|max:255',
            'required_mods'   => 'nullable|string|max:255',
            'description'     => 'nullable|string|max:1000',
            'donators'        => 'nullable|string|max:255',
            'reward'          => 'required|string|max:255',
            'completed_by'    => 'nullable|string|max:255',
            'completed_at'    => 'nullable|date',
            'completed'       => 'nullable|boolean',
            'beatmap_image'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $bounty->fill($request->except(['beatmap_image', 'completed', 'completed_by', 'completed_at']));

        if ($request->has('completed') && $request->completed) {
            $bounty->completed = 1;
            $bounty->completed_by = $request->input('completed_by');
            $bounty->completed_at = $request->input('completed_at');
        } else {
            $bounty->completed = 0;
            $bounty->completed_by = null;
            $bounty->completed_at = null;
        }

        if ($request->hasFile('beatmap_image')) {
            $imageName = time() . '.' . $request->beatmap_image->extension();
            $request->beatmap_image->move(public_path('images/beatmaps'), $imageName);
            $bounty->beatmap_image = $imageName;
        }

        $bounty->save();

        return redirect()->route('admin.requests')->with('success', 'Bounty updated successfully!');
    }
}
