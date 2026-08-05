<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;

class TrackerController extends Controller
{
    public function index()
    {
        $teams = Team::with('players')->latest()->get();

        $players = Player::with('team')->latest()->get();

        $currentGame = Game::with(['homeTeam', 'awayTeam', 'players'])
            ->orderByRaw("status = 'live' desc")
            ->orderBy('game_date')
            ->first();

        return view('tracker.index', compact('teams', 'players', 'currentGame'));
    }
}
