<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $query = Player::with('team')->select('*');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%")
                  ->orWhereHas('team', function ($teamQuery) use ($search) {
                      $teamQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('team')) {
            $query->where('team_id', $request->input('team'));
        }

        if ($request->filled('position')) {
            $query->where('position', $request->input('position'));
        }

        $sortField = $request->input('sort', 'batting_home_runs');
        $sortDirection = $request->input('direction', 'desc');
        $allowedSorts = ['name', 'position', 'batting_home_runs', 'batting_avg', 'pitching_wins', 'fielding_percentage'];

        if (!in_array($sortField, $allowedSorts, true)) {
            $sortField = 'batting_home_runs';
        }

        $players = $query->orderBy($sortField, $sortDirection)->paginate(12)->appends($request->query());
        $teams = Team::orderBy('name')->get();

        return view('stats.index', compact('players', 'teams'));
    }
}
