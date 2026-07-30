<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(Team $team)
    {
        return view('players.index', [
            'team' => $team->load('players'),
        ]);
    }

    public function create(Team $team)
    {
        return view('players.create', compact('team'));
    }

    public function store(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:10'],
            'jersey_number' => ['nullable', 'integer'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'pitching_games' => ['nullable', 'integer'],
            'pitching_wins' => ['nullable', 'integer'],
            'pitching_losses' => ['nullable', 'integer'],
            'pitching_era' => ['nullable', 'numeric'],
            'pitching_strikeouts' => ['nullable', 'integer'],
            'pitching_innings_pitched' => ['nullable', 'numeric'],
            'batting_games' => ['nullable', 'integer'],
            'batting_avg' => ['nullable', 'numeric'],
            'batting_home_runs' => ['nullable', 'integer'],
            'batting_rbi' => ['nullable', 'integer'],
            'batting_hits' => ['nullable', 'integer'],
            'batting_runs' => ['nullable', 'integer'],
            'batting_stolen_bases' => ['nullable', 'integer'],
            'fielding_putouts' => ['nullable', 'integer'],
            'fielding_assists' => ['nullable', 'integer'],
            'fielding_errors' => ['nullable', 'integer'],
            'fielding_percentage' => ['nullable', 'numeric'],
        ]);

        $team->players()->create($validated);

        return redirect()->route('teams.players.index', $team)->with('status', 'Player created successfully.');
    }

    public function edit(Team $team, Player $player)
    {
        return view('players.edit', compact('team', 'player'));
    }

    public function update(Request $request, Team $team, Player $player)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:10'],
            'jersey_number' => ['nullable', 'integer'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'pitching_games' => ['nullable', 'integer'],
            'pitching_wins' => ['nullable', 'integer'],
            'pitching_losses' => ['nullable', 'integer'],
            'pitching_era' => ['nullable', 'numeric'],
            'pitching_strikeouts' => ['nullable', 'integer'],
            'pitching_innings_pitched' => ['nullable', 'numeric'],
            'batting_games' => ['nullable', 'integer'],
            'batting_avg' => ['nullable', 'numeric'],
            'batting_home_runs' => ['nullable', 'integer'],
            'batting_rbi' => ['nullable', 'integer'],
            'batting_hits' => ['nullable', 'integer'],
            'batting_runs' => ['nullable', 'integer'],
            'batting_stolen_bases' => ['nullable', 'integer'],
            'fielding_putouts' => ['nullable', 'integer'],
            'fielding_assists' => ['nullable', 'integer'],
            'fielding_errors' => ['nullable', 'integer'],
            'fielding_percentage' => ['nullable', 'numeric'],
        ]);

        $player->update($validated);

        return redirect()->route('teams.players.index', $team)->with('status', 'Player updated successfully.');
    }

    public function destroy(Team $team, Player $player)
    {
        $player->delete();

        return redirect()->route('teams.players.index', $team)->with('status', 'Player deleted successfully.');
    }
}
