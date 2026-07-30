<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['homeTeam', 'awayTeam'])->latest()->get();

        return view('games.index', compact('games'));
    }

    public function create()
    {
        $teams = Team::with('players')->get();

        return view('games.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team_id' => ['required', 'exists:teams,id'],
            'away_team_id' => ['required', 'exists:teams,id'],
            'home_roster' => ['nullable', 'array'],
            'away_roster' => ['nullable', 'array'],
            'game_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $game = Game::create([
            'home_team_id' => $validated['home_team_id'],
            'away_team_id' => $validated['away_team_id'],
            'game_date' => $validated['game_date'],
            'location' => $validated['location'] ?? null,
            'inning' => 1,
            'outs' => 0,
            'balls' => 0,
            'strikes' => 0,
            'home_score' => 0,
            'away_score' => 0,
            'status' => 'scheduled',
            'last_play' => null,
            'home_lineup' => $validated['home_roster'] ?? [],
            'away_lineup' => $validated['away_roster'] ?? [],
        ]);

        if (!empty($validated['home_roster'])) {
            $game->players()->sync($validated['home_roster']);
        }

        if (!empty($validated['away_roster'])) {
            $game->players()->syncWithoutDetaching($validated['away_roster']);
        }

        return redirect()->route('games.index')->with('status', 'Game created successfully.');
    }

    public function show(Game $game)
    {
        $game->load(['homeTeam', 'awayTeam']);

        return view('games.show', compact('game'));
    }

    public function score(Request $request, Game $game)
    {
        $validated = $request->validate([
            'event' => ['required', 'string', 'max:255'],
        ]);

        $event = $validated['event'];
        $inning = $game->inning;
        $outs = $game->outs;
        $balls = $game->balls;
        $strikes = $game->strikes;
        $homeScore = $game->home_score;
        $awayScore = $game->away_score;

        switch ($event) {
            case 'single':
            case 'double':
            case 'triple':
            case 'home-run':
                $homeScore += ($event === 'home-run' ? 1 : 0);
                $awayScore += ($event === 'away-run' ? 1 : 0);
                $balls = 0;
                $strikes = 0;
                break;
            case 'walk':
                $balls = 0;
                $strikes = 0;
                break;
            case 'strikeout':
                $outs = $outs + 1;
                $balls = 0;
                $strikes = 0;
                break;
            case 'inning-end':
                $outs = 0;
                $balls = 0;
                $strikes = 0;
                $inning = $inning + 1;
                break;
            default:
                break;
        }

        if ($outs >= 3) {
            $outs = 0;
            $inning = $inning + 1;
            $balls = 0;
            $strikes = 0;
        }

        $game->update([
            'last_play' => ucfirst(str_replace('-', ' ', $event)),
            'status' => 'live',
            'inning' => $inning,
            'outs' => $outs,
            'balls' => $balls,
            'strikes' => $strikes,
            'home_score' => $homeScore,
            'away_score' => $awayScore,
        ]);

        return redirect()->route('games.show', $game)->with('status', 'Play recorded.');
    }
}
