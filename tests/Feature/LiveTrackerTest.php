<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LiveTrackerTest extends TestCase
{
    use RefreshDatabase;

    public function test_live_tracker_page_shows_position_based_stats(): void
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

        $pitcher = Player::create([
            'team_id' => $team->id,
            'name' => 'Mason Cole',
            'position' => 'SP',
            'jersey_number' => 24,
            'pitching_games' => 28,
            'pitching_wins' => 14,
            'pitching_losses' => 7,
            'pitching_era' => 3.12,
            'pitching_strikeouts' => 182,
        ]);

        $fielder = Player::create([
            'team_id' => $team->id,
            'name' => 'Drew Alvarez',
            'position' => 'SS',
            'jersey_number' => 7,
            'batting_games' => 132,
            'batting_avg' => 0.312,
            'batting_home_runs' => 18,
            'batting_rbi' => 74,
            'fielding_putouts' => 120,
            'fielding_assists' => 92,
            'fielding_errors' => 3,
            'fielding_percentage' => 0.978,
        ]);

        $response = $this->get('/live-tracker');

        $response->assertOk();
        $response->assertSee($pitcher->name);
        $response->assertSee('ERA');
        $response->assertSee($fielder->name);
        $response->assertSee('AVG');
    }
}
