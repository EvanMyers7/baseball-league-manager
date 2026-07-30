<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_lists_existing_teams(): void
    {
        Team::create([
            'name' => 'Chicago Cubs',
            'city' => 'Chicago',
            'abbreviation' => 'CHC',
            'primary_color' => '#0E3386',
            'secondary_color' => '#CC3433',
            'stadium' => 'Wrigley Field',
            'founded_year' => 1874,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Chicago Cubs');
        $response->assertSee('Teams');
    }

    public function test_can_create_a_team(): void
    {
        $response = $this->post(route('teams.store'), [
            'name' => 'New York Yankees',
            'city' => 'New York',
            'abbreviation' => 'NYY',
            'primary_color' => '#003087',
            'secondary_color' => '#FFFFFF',
            'stadium' => 'Yankee Stadium',
            'founded_year' => 1903,
        ]);

        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseHas('teams', [
            'name' => 'New York Yankees',
            'abbreviation' => 'NYY',
        ]);

        $this->get(route('teams.index'))->assertSee('New York Yankees');
    }

    public function test_dashboard_shows_seeded_teams(): void
    {
        $this->seed();

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Chicago Cubs');
        $response->assertSee('New York Yankees');
    }

    public function test_can_update_a_team_and_store_an_image(): void
    {
        $team = Team::create([
            'name' => 'Boston Red Sox',
            'city' => 'Boston',
            'abbreviation' => 'BOS',
            'primary_color' => '#BD3039',
            'secondary_color' => '#0C2340',
            'stadium' => 'Fenway Park',
            'founded_year' => 1901,
        ]);

        $response = $this->put(route('teams.update', $team), [
            'name' => 'Boston Red Sox',
            'city' => 'Boston',
            'abbreviation' => 'BOS',
            'primary_color' => '#BD3039',
            'secondary_color' => '#0C2340',
            'stadium' => 'Fenway Park',
            'founded_year' => 1901,
            'image_url' => 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e',
            'avatar_fit' => 'contain',
            'avatar_shape' => 'circle',
            'avatar_bg_color' => '#0f172a',
            'avatar_text_color' => '#f8fafc',
        ]);

        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'image_url' => 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e',
            'avatar_fit' => 'contain',
            'avatar_shape' => 'circle',
            'avatar_bg_color' => '#0f172a',
            'avatar_text_color' => '#f8fafc',
        ]);
    }

    public function test_can_delete_a_team(): void
    {
        $team = Team::create([
            'name' => 'Detroit Tigers',
            'city' => 'Detroit',
            'abbreviation' => 'DET',
            'primary_color' => '#0C2340',
            'secondary_color' => '#FA4616',
            'stadium' => 'Comerica Park',
            'founded_year' => 1894,
        ]);

        $response = $this->delete(route('teams.destroy', $team));

        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    }

    public function test_can_store_avatar_editor_positioning_values(): void
    {
        $team = Team::create([
            'name' => 'Los Angeles Dodgers',
            'city' => 'Los Angeles',
            'abbreviation' => 'LAD',
            'primary_color' => '#005A9C',
            'secondary_color' => '#EF3E42',
            'stadium' => 'Dodger Stadium',
            'founded_year' => 1883,
        ]);

        $response = $this->put(route('teams.update', $team), [
            'name' => 'Los Angeles Dodgers',
            'city' => 'Los Angeles',
            'abbreviation' => 'LAD',
            'primary_color' => '#005A9C',
            'secondary_color' => '#EF3E42',
            'stadium' => 'Dodger Stadium',
            'founded_year' => 1883,
            'image_url' => 'https://example.com/dodgers.jpg',
            'avatar_fit' => 'cover',
            'avatar_shape' => 'rounded',
            'avatar_bg_color' => '#0f172a',
            'avatar_text_color' => '#ffffff',
            'avatar_offset_x' => 24,
            'avatar_offset_y' => -8,
            'avatar_scale' => 1.25,
        ]);

        $response->assertRedirect(route('teams.index'));
        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'avatar_offset_x' => 24,
            'avatar_offset_y' => -8,
            'avatar_scale' => 1.25,
        ]);
    }
}
