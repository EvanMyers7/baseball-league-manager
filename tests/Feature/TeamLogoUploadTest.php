<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TeamLogoUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_logo_upload_is_saved_and_visible(): void
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

        $file = UploadedFile::fake()->image('logo.png', 200, 200);

        $response = $this->put(route('teams.update', $team), [
            'name' => 'Test Team',
            'city' => 'Test City',
            'abbreviation' => 'TST',
            'primary_color' => '#123456',
            'secondary_color' => '#654321',
            'stadium' => 'Test Stadium',
            'founded_year' => 2000,
            'image_url' => null,
            'logo_file' => $file,
            'avatar_fit' => 'contain',
            'avatar_shape' => 'rounded',
            'avatar_bg_color' => '#0f172a',
            'avatar_text_color' => '#ffffff',
            'avatar_offset_x' => 0,
            'avatar_offset_y' => 0,
            'avatar_scale' => 1,
        ]);

        $response->assertRedirect(route('teams.index'));
        $team->refresh();
        $this->assertNotNull($team->image_url);
        $this->assertStringContainsString('uploads/teams/', $team->image_url);
    }
}
