<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Bounty;

class BountiesController extends Controller
{
    public function index()
    {
        $bounties = \App\Models\Bounty::all();
        return view('bounties', compact('bounties'));
    }
}
