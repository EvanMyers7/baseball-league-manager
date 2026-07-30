<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameScoringTest extends TestCase
{
    use RefreshDatabase;

    public function test_games_can_be_created_with_rosters_and_scored(): void
    {
        $home = Team::create([
            'name' => 'River City Rockets',
            'city' => 'River City',
            'abbreviation' => 'RCR',
            'primary_color' => '#f7b731',
            'secondary_color' => '#07111f',
            'stadium' => 'Harbor Park',
            'founded_year' => 2001,
        ]);

        $away = Team::create([
            'name' => 'North Harbor Hawks',
            'city' => 'North Harbor',
            'abbreviation' => 'NHH',
            'primary_color' => '#4f46e5',
            'secondary_color' => '#07111f',
            'stadium' => 'Bayfront',
            'founded_year' => 2002,
        ]);

        $homePlayer = Player::create([
            'team_id' => $home->id,
            'name' => 'Mason Cole',
            'position' => 'SP',
            'jersey_number' => 24,
            'pitching_games' => 20,
            'pitching_wins' => 10,
            'pitching_losses' => 4,
            'pitching_era' => 3.10,
            'pitching_strikeouts' => 150,
        ]);

        $awayPlayer = Player::create([
            'team_id' => $away->id,
            'name' => 'Drew Alvarez',
            'position' => 'SS',
            'jersey_number' => 7,
            'batting_games' => 110,
            'batting_avg' => 0.312,
            'batting_home_runs' => 18,
            'batting_rbi' => 74,
        ]);

        $response = $this->post('/games', [
            'home_team_id' => $home->id,
            'away_team_id' => $away->id,
            'home_roster' => [$homePlayer->id],
            'away_roster' => [$awayPlayer->id],
            'game_date' => '2026-07-30',
            'location' => 'Harbor Park',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('games', ['home_team_id' => $home->id, 'away_team_id' => $away->id]);

        $game = \App\Models\Game::latest()->first();

        $scoreResponse = $this->post('/games/'.$game->id.'/scoreboard', ['event' => 'single']);
        $scoreResponse->assertRedirect();
        $this->assertDatabaseHas('games', ['id' => $game->id, 'last_play' => 'Single']);
    }
}
