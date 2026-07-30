<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_crud_workflow(): void
    {
        $team = Team::create([
            'name' => 'River City Rockets',
            'city' => 'River City',
            'abbreviation' => 'RCR',
            'primary_color' => '#f7b731',
            'secondary_color' => '#07111f',
            'stadium' => 'Harbor Park',
            'founded_year' => 2001,
            'image_url' => 'https://example.com/rocket.png',
        ]);

        $response = $this->post('/teams/'.$team->id.'/players', [
            'name' => 'Mason Cole',
            'position' => 'SP',
            'jersey_number' => 24,
            'pitching_games' => 28,
            'pitching_wins' => 14,
            'pitching_losses' => 7,
            'pitching_era' => 3.12,
            'pitching_strikeouts' => 182,
            'batting_games' => 0,
            'batting_avg' => 0.000,
            'batting_home_runs' => 0,
            'batting_rbi' => 0,
            'batting_hits' => 0,
            'batting_runs' => 0,
            'batting_stolen_bases' => 0,
            'fielding_putouts' => 0,
            'fielding_assists' => 0,
            'fielding_errors' => 0,
            'fielding_percentage' => 0.000,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('players', ['name' => 'Mason Cole']);
    }
}
