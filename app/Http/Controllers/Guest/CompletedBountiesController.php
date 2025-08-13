<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Bounty;

class CompletedBountiesController extends Controller
{
    public function index()
    {
        $bounties = \App\Models\Bounty::all();
        return view('completed-bounties', compact('bounties'));
    }
}
