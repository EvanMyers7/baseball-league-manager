<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $teams = [
            ['name' => 'New York Yankees', 'city' => 'New York', 'abbreviation' => 'NYY', 'primary_color' => '#132448', 'secondary_color' => '#ffffff', 'stadium' => 'Yankee Stadium', 'founded_year' => 1903, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/2/25/New_York_Yankees_logo.svg'],
            ['name' => 'Boston Red Sox', 'city' => 'Boston', 'abbreviation' => 'BOS', 'primary_color' => '#bd3039', 'secondary_color' => '#ffffff', 'stadium' => 'Fenway Park', 'founded_year' => 1901, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/6/6d/RedSoxPrimary_Hero.svg'],
            ['name' => 'Toronto Blue Jays', 'city' => 'Toronto', 'abbreviation' => 'TOR', 'primary_color' => '#134a8e', 'secondary_color' => '#ffffff', 'stadium' => 'Rogers Centre', 'founded_year' => 1977, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/6/6e/Toronto_Blue_Jays_logo.svg'],
            ['name' => 'Baltimore Orioles', 'city' => 'Baltimore', 'abbreviation' => 'BAL', 'primary_color' => '#df4601', 'secondary_color' => '#000000', 'stadium' => 'Camden Yards', 'founded_year' => 1901, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/7/7b/Baltimore_Orioles_logo.svg'],
            ['name' => 'Tampa Bay Rays', 'city' => 'St. Petersburg', 'abbreviation' => 'TBR', 'primary_color' => '#8fbce6', 'secondary_color' => '#092c5c', 'stadium' => 'Tropicana Field', 'founded_year' => 1998, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/2/2f/Tampa_Bay_Rays_logo.svg'],
            ['name' => 'Los Angeles Dodgers', 'city' => 'Los Angeles', 'abbreviation' => 'LAD', 'primary_color' => '#005a9c', 'secondary_color' => '#ffffff', 'stadium' => 'Dodger Stadium', 'founded_year' => 1883, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/0/0f/Los_Angeles_Dodgers_logo.svg'],
            ['name' => 'San Francisco Giants', 'city' => 'San Francisco', 'abbreviation' => 'SFG', 'primary_color' => '#fd5a1e', 'secondary_color' => '#000000', 'stadium' => 'Oracle Park', 'founded_year' => 1883, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/5/58/San_Francisco_Giants_logo.svg'],
            ['name' => 'San Diego Padres', 'city' => 'San Diego', 'abbreviation' => 'SDP', 'primary_color' => '#2f241d', 'secondary_color' => '#ffc425', 'stadium' => 'Petco Park', 'founded_year' => 1969, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/3/3b/San_Diego_Padres_logo.svg'],
            ['name' => 'Arizona Diamondbacks', 'city' => 'Phoenix', 'abbreviation' => 'AZD', 'primary_color' => '#a71930', 'secondary_color' => '#000000', 'stadium' => 'Chase Field', 'founded_year' => 1998, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/4/4d/Arizona_Diamondbacks_logo.svg'],
            ['name' => 'Colorado Rockies', 'city' => 'Denver', 'abbreviation' => 'COL', 'primary_color' => '#33006f', 'secondary_color' => '#c4ced4', 'stadium' => 'Coors Field', 'founded_year' => 1993, 'image_url' => 'https://upload.wikimedia.org/wikipedia/en/0/0d/Colorado_Rockies_logo.svg'],
        ];

        $createdTeams = [];
        foreach ($teams as $teamData) {
            $createdTeams[] = Team::create($teamData);
        }

        $rosters = [
            ['team' => 0, 'players' => [
                ['name' => 'Gerrit Cole', 'position' => 'SP', 'jersey_number' => 45, 'pitching_games' => 33, 'pitching_wins' => 8, 'pitching_losses' => 5, 'pitching_era' => 3.41, 'pitching_strikeouts' => 222, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Aaron Judge', 'position' => 'RF', 'jersey_number' => 99, 'batting_games' => 158, 'batting_avg' => 0.322, 'batting_home_runs' => 58, 'batting_rbi' => 144, 'batting_hits' => 185, 'batting_runs' => 133, 'batting_stolen_bases' => 10, 'fielding_putouts' => 223, 'fielding_assists' => 3, 'fielding_errors' => 1, 'fielding_percentage' => 0.996],
                ['name' => 'Anthony Volpe', 'position' => 'SS', 'jersey_number' => 11, 'batting_games' => 141, 'batting_avg' => 0.243, 'batting_home_runs' => 21, 'batting_rbi' => 60, 'batting_hits' => 120, 'batting_runs' => 86, 'batting_stolen_bases' => 28, 'fielding_putouts' => 140, 'fielding_assists' => 305, 'fielding_errors' => 16, 'fielding_percentage' => 0.966],
            ]],
            ['team' => 1, 'players' => [
                ['name' => 'Garrett Crochet', 'position' => 'SP', 'jersey_number' => 45, 'pitching_games' => 32, 'pitching_wins' => 6, 'pitching_losses' => 12, 'pitching_era' => 4.97, 'pitching_strikeouts' => 209, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Rafael Devers', 'position' => '3B', 'jersey_number' => 11, 'batting_games' => 153, 'batting_avg' => 0.280, 'batting_home_runs' => 33, 'batting_rbi' => 100, 'batting_hits' => 180, 'batting_runs' => 90, 'batting_stolen_bases' => 2, 'fielding_putouts' => 92, 'fielding_assists' => 161, 'fielding_errors' => 9, 'fielding_percentage' => 0.966],
                ['name' => 'Jarren Duran', 'position' => 'LF', 'jersey_number' => 16, 'batting_games' => 160, 'batting_avg' => 0.285, 'batting_home_runs' => 21, 'batting_rbi' => 89, 'batting_hits' => 197, 'batting_runs' => 111, 'batting_stolen_bases' => 34, 'fielding_putouts' => 221, 'fielding_assists' => 9, 'fielding_errors' => 4, 'fielding_percentage' => 0.983],
            ]],
            ['team' => 2, 'players' => [
                ['name' => 'José Berríos', 'position' => 'SP', 'jersey_number' => 17, 'pitching_games' => 32, 'pitching_wins' => 16, 'pitching_losses' => 7, 'pitching_era' => 3.60, 'pitching_strikeouts' => 189, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Vladimir Guerrero Jr.', 'position' => '1B', 'jersey_number' => 27, 'batting_games' => 159, 'batting_avg' => 0.323, 'batting_home_runs' => 30, 'batting_rbi' => 103, 'batting_hits' => 210, 'batting_runs' => 98, 'batting_stolen_bases' => 2, 'fielding_putouts' => 1270, 'fielding_assists' => 12, 'fielding_errors' => 3, 'fielding_percentage' => 0.997],
                ['name' => 'Bo Bichette', 'position' => 'SS', 'jersey_number' => 11, 'batting_games' => 156, 'batting_avg' => 0.289, 'batting_home_runs' => 20, 'batting_rbi' => 93, 'batting_hits' => 193, 'batting_runs' => 102, 'batting_stolen_bases' => 25, 'fielding_putouts' => 154, 'fielding_assists' => 322, 'fielding_errors' => 10, 'fielding_percentage' => 0.979],
            ]],
            ['team' => 3, 'players' => [
                ['name' => 'Corbin Burnes', 'position' => 'SP', 'jersey_number' => 39, 'pitching_games' => 32, 'pitching_wins' => 15, 'pitching_losses' => 9, 'pitching_era' => 3.28, 'pitching_strikeouts' => 221, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Gunnar Henderson', 'position' => '3B', 'jersey_number' => 9, 'batting_games' => 160, 'batting_avg' => 0.281, 'batting_home_runs' => 37, 'batting_rbi' => 92, 'batting_hits' => 188, 'batting_runs' => 122, 'batting_stolen_bases' => 10, 'fielding_putouts' => 106, 'fielding_assists' => 110, 'fielding_errors' => 9, 'fielding_percentage' => 0.960],
                ['name' => 'Adley Rutschman', 'position' => 'C', 'jersey_number' => 35, 'batting_games' => 143, 'batting_avg' => 0.285, 'batting_home_runs' => 19, 'batting_rbi' => 80, 'batting_hits' => 171, 'batting_runs' => 80, 'batting_stolen_bases' => 4, 'fielding_putouts' => 817, 'fielding_assists' => 63, 'fielding_errors' => 7, 'fielding_percentage' => 0.992],
            ]],
            ['team' => 4, 'players' => [
                ['name' => 'Shane McClanahan', 'position' => 'SP', 'jersey_number' => 18, 'pitching_games' => 25, 'pitching_wins' => 11, 'pitching_losses' => 2, 'pitching_era' => 2.54, 'pitching_strikeouts' => 194, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Brandon Lowe', 'position' => '2B', 'jersey_number' => 8, 'batting_games' => 136, 'batting_avg' => 0.244, 'batting_home_runs' => 21, 'batting_rbi' => 72, 'batting_hits' => 145, 'batting_runs' => 70, 'batting_stolen_bases' => 8, 'fielding_putouts' => 138, 'fielding_assists' => 204, 'fielding_errors' => 11, 'fielding_percentage' => 0.970],
                ['name' => 'Yandy Díaz', 'position' => 'DH', 'jersey_number' => 2, 'batting_games' => 153, 'batting_avg' => 0.281, 'batting_home_runs' => 22, 'batting_rbi' => 78, 'batting_hits' => 171, 'batting_runs' => 74, 'batting_stolen_bases' => 2, 'fielding_putouts' => 6, 'fielding_assists' => 1, 'fielding_errors' => 0, 'fielding_percentage' => 1.000],
            ]],
            ['team' => 5, 'players' => [
                ['name' => 'Tyler Glasnow', 'position' => 'SP', 'jersey_number' => 20, 'pitching_games' => 22, 'pitching_wins' => 9, 'pitching_losses' => 6, 'pitching_era' => 3.53, 'pitching_strikeouts' => 162, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Mookie Betts', 'position' => 'RF', 'jersey_number' => 50, 'batting_games' => 152, 'batting_avg' => 0.289, 'batting_home_runs' => 39, 'batting_rbi' => 107, 'batting_hits' => 198, 'batting_runs' => 111, 'batting_stolen_bases' => 14, 'fielding_putouts' => 209, 'fielding_assists' => 13, 'fielding_errors' => 3, 'fielding_percentage' => 0.987],
                ['name' => 'Will Smith', 'position' => 'C', 'jersey_number' => 16, 'batting_games' => 145, 'batting_avg' => 0.248, 'batting_home_runs' => 20, 'batting_rbi' => 75, 'batting_hits' => 136, 'batting_runs' => 80, 'batting_stolen_bases' => 1, 'fielding_putouts' => 769, 'fielding_assists' => 43, 'fielding_errors' => 8, 'fielding_percentage' => 0.990],
            ]],
            ['team' => 6, 'players' => [
                ['name' => 'Logan Webb', 'position' => 'SP', 'jersey_number' => 62, 'pitching_games' => 33, 'pitching_wins' => 14, 'pitching_losses' => 10, 'pitching_era' => 3.35, 'pitching_strikeouts' => 216, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Matt Chapman', 'position' => '3B', 'jersey_number' => 26, 'batting_games' => 152, 'batting_avg' => 0.240, 'batting_home_runs' => 27, 'batting_rbi' => 80, 'batting_hits' => 154, 'batting_runs' => 78, 'batting_stolen_bases' => 8, 'fielding_putouts' => 121, 'fielding_assists' => 166, 'fielding_errors' => 16, 'fielding_percentage' => 0.946],
                ['name' => 'Heliot Ramos', 'position' => 'CF', 'jersey_number' => 19, 'batting_games' => 104, 'batting_avg' => 0.269, 'batting_home_runs' => 20, 'batting_rbi' => 55, 'batting_hits' => 107, 'batting_runs' => 60, 'batting_stolen_bases' => 6, 'fielding_putouts' => 195, 'fielding_assists' => 4, 'fielding_errors' => 3, 'fielding_percentage' => 0.985],
            ]],
            ['team' => 7, 'players' => [
                ['name' => 'Dylan Cease', 'position' => 'SP', 'jersey_number' => 40, 'pitching_games' => 33, 'pitching_wins' => 14, 'pitching_losses' => 11, 'pitching_era' => 3.47, 'pitching_strikeouts' => 224, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Fernando Tatis Jr.', 'position' => 'RF', 'jersey_number' => 23, 'batting_games' => 102, 'batting_avg' => 0.279, 'batting_home_runs' => 25, 'batting_rbi' => 78, 'batting_hits' => 97, 'batting_runs' => 74, 'batting_stolen_bases' => 14, 'fielding_putouts' => 190, 'fielding_assists' => 6, 'fielding_errors' => 3, 'fielding_percentage' => 0.985],
                ['name' => 'Manny Machado', 'position' => '3B', 'jersey_number' => 13, 'batting_games' => 153, 'batting_avg' => 0.275, 'batting_home_runs' => 29, 'batting_rbi' => 105, 'batting_hits' => 180, 'batting_runs' => 100, 'batting_stolen_bases' => 14, 'fielding_putouts' => 123, 'fielding_assists' => 170, 'fielding_errors' => 9, 'fielding_percentage' => 0.967],
            ]],
            ['team' => 8, 'players' => [
                ['name' => 'Zac Gallen', 'position' => 'SP', 'jersey_number' => 7, 'pitching_games' => 34, 'pitching_wins' => 14, 'pitching_losses' => 13, 'pitching_era' => 3.65, 'pitching_strikeouts' => 220, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Ketel Marte', 'position' => '2B', 'jersey_number' => 4, 'batting_games' => 153, 'batting_avg' => 0.292, 'batting_home_runs' => 36, 'batting_rbi' => 95, 'batting_hits' => 193, 'batting_runs' => 106, 'batting_stolen_bases' => 8, 'fielding_putouts' => 157, 'fielding_assists' => 250, 'fielding_errors' => 9, 'fielding_percentage' => 0.978],
                ['name' => 'Corbin Carroll', 'position' => 'CF', 'jersey_number' => 7, 'batting_games' => 155, 'batting_avg' => 0.285, 'batting_home_runs' => 25, 'batting_rbi' => 76, 'batting_hits' => 191, 'batting_runs' => 116, 'batting_stolen_bases' => 54, 'fielding_putouts' => 213, 'fielding_assists' => 6, 'fielding_errors' => 1, 'fielding_percentage' => 0.995],
            ]],
            ['team' => 9, 'players' => [
                ['name' => 'Kyle Freeland', 'position' => 'SP', 'jersey_number' => 21, 'pitching_games' => 32, 'pitching_wins' => 5, 'pitching_losses' => 8, 'pitching_era' => 4.43, 'pitching_strikeouts' => 159, 'batting_games' => 0, 'batting_avg' => 0.000, 'batting_home_runs' => 0, 'batting_rbi' => 0, 'fielding_putouts' => 0, 'fielding_assists' => 0, 'fielding_errors' => 0, 'fielding_percentage' => 0.000],
                ['name' => 'Brenton Doyle', 'position' => 'CF', 'jersey_number' => 6, 'batting_games' => 150, 'batting_avg' => 0.260, 'batting_home_runs' => 16, 'batting_rbi' => 73, 'batting_hits' => 161, 'batting_runs' => 81, 'batting_stolen_bases' => 23, 'fielding_putouts' => 250, 'fielding_assists' => 7, 'fielding_errors' => 2, 'fielding_percentage' => 0.992],
                ['name' => 'Charlie Blackmon', 'position' => 'RF', 'jersey_number' => 19, 'batting_games' => 151, 'batting_avg' => 0.264, 'batting_home_runs' => 16, 'batting_rbi' => 74, 'batting_hits' => 173, 'batting_runs' => 89, 'batting_stolen_bases' => 6, 'fielding_putouts' => 214, 'fielding_assists' => 7, 'fielding_errors' => 1, 'fielding_percentage' => 0.996],
            ]],
        ];

        foreach ($rosters as $rosterData) {
            $team = $createdTeams[$rosterData['team']];
            foreach ($rosterData['players'] as $playerData) {
                $team->players()->create($playerData);
            }
        }

        $fixtures = [
            ['home' => 0, 'away' => 1, 'date' => '2026-07-30', 'location' => 'Fenway Park'],
            ['home' => 2, 'away' => 3, 'date' => '2026-07-30', 'location' => 'Camden Yards'],
            ['home' => 4, 'away' => 5, 'date' => '2026-07-30', 'location' => 'Tropicana Field'],
            ['home' => 6, 'away' => 7, 'date' => '2026-07-30', 'location' => 'Oracle Park'],
            ['home' => 8, 'away' => 9, 'date' => '2026-07-30', 'location' => 'Chase Field'],
        ];

        foreach ($fixtures as $fixture) {
            $homeTeam = $createdTeams[$fixture['home']];
            $awayTeam = $createdTeams[$fixture['away']];
            $game = Game::create([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'game_date' => $fixture['date'],
                'location' => $fixture['location'],
                'inning' => 1,
                'outs' => 0,
                'balls' => 0,
                'strikes' => 0,
                'home_score' => 0,
                'away_score' => 0,
                'status' => 'scheduled',
                'last_play' => 'Game ready',
                'home_lineup' => $homeTeam->players->pluck('id')->take(3)->toArray(),
                'away_lineup' => $awayTeam->players->pluck('id')->take(3)->toArray(),
            ]);

            $homeRoster = $homeTeam->players->pluck('id')->take(3)->toArray();
            $awayRoster = $awayTeam->players->pluck('id')->take(3)->toArray();
            $game->players()->sync([...$homeRoster, ...$awayRoster]);
        }
    }
}
