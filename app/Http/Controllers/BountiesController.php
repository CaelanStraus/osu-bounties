<?php

namespace App\Http\Controllers;

use App\Models\Bounty;

class BountiesController extends Controller
{
    public function index()
    {
        $bounties = \App\Models\Bounty::all();
        return view('bounties', compact('bounties'));
    }
}
