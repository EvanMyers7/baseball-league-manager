<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;

class TrackerController extends Controller
{
    public function index()
    {
        $teams = Team::with('players')->latest()->get();

        $players = Player::with('team')->latest()->get();

        return view('tracker.index', compact('teams', 'players'));
    }
}
