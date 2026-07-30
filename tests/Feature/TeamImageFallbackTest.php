<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamImageFallbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_edit_page_uses_local_placeholder_when_no_image_url_is_present(): void
    {
        $team = Team::create([
            'name' => 'Test Team',
            'city' => 'Test City',
            'abbreviation' => 'TST',
            'primary_color' => '#123456',
            'secondary_color' => '#654321',
            'stadium' => 'Test Stadium',
            'founded_year' => 2000,
            'image_url' => null,
        ]);

        $response = $this->get(route('teams.edit', $team));

        $response->assertStatus(200);
        $response->assertSee(asset('images/team-placeholder.svg'));
    }
}
