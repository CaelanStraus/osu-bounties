<?php

namespace App\Http\Controllers\User;

use App\Models\ClaimedBounty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClaimBountyController extends Controller
{
    public function store($bountyId, \Illuminate\Http\Request $request)
    {
        $request->validate([
            'contact_info' => 'required|string|max:255',
        ]);

        if (ClaimedBounty::where('bounty_id', $bountyId)->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You already claimed this bounty.');
        }

        ClaimedBounty::create([
            'bounty_id'    => $bountyId,
            'user_id'      => Auth::id(),
            'contact_info' => $request->contact_info,
        ]);

        return back()->with('success', 'Bounty claimed successfully.');
    }

    public function destroy($id)
    {
        $claimedBounty = ClaimedBounty::findOrFail($id);

        $claimedBounty->delete();

        return back()->with('success', 'Claimed bounty deleted successfully.');
    }

    public function verify($id)
    {
        $bounty = ClaimedBounty::findOrFail($id);
        $bounty->verified = 1;
        $bounty->save();

        return redirect()->back()->with('success', 'Claim verified successfully!');
    }
}