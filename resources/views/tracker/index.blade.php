<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Tracker</title>
    <style>
        :root {
            --bg: #07111f;
            --panel: #0f1c2c;
            --text: #f4f7fb;
            --muted: #8aa0b8;
            --accent: #f7b731;
            --accent-2: #ff6b6b;
            --border: rgba(255,255,255,0.12);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: linear-gradient(135deg, var(--bg), #12263d 55%, #1c3551);
            color: var(--text);
            min-height: 100vh;
            padding: 24px;
        }
        .shell { max-width: 1200px; margin: 0 auto; }
        .hero, .card { background: rgba(15, 28, 44, 0.92); border: 1px solid var(--border); border-radius: 22px; box-shadow: 0 16px 40px rgba(0,0,0,0.2); }
        .hero { padding: 24px; margin-bottom: 18px; }
        .hero h1 { margin: 0 0 8px; font-size: 1.8rem; }
        .hero p { color: var(--muted); margin: 0; }
        .pill { display: inline-block; margin-bottom: 10px; background: rgba(247,183,49,0.16); color: var(--accent); padding: 4px 10px; border-radius: 999px; font-size: 0.8rem; font-weight: 700; }
        .grid { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 18px; }
        .card { padding: 18px; }
        .card h2 { margin-top: 0; font-size: 1.1rem; }
        .team-card { border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 14px; background: rgba(255,255,255,0.03); margin-bottom: 12px; }
        .player-list { display: grid; gap: 10px; }
        .player-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 10px 12px; border-radius: 14px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06); }
        .player-meta strong { display: block; }
        .player-meta span { color: var(--muted); font-size: 0.9rem; }
        .stat-pill { display: inline-block; padding: 4px 8px; border-radius: 999px; background: rgba(255,255,255,0.08); font-size: 0.8rem; }
        .stats-grid { display: grid; gap: 8px; margin-top: 8px; }
        .stats-grid .row { display: flex; justify-content: space-between; font-size: 0.92rem; color: var(--muted); }
        .stats-grid .row strong { color: var(--text); }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 999px; background: rgba(255,255,255,0.08); font-size: 0.78rem; margin-top: 6px; }
        .team-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .stat-box { border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 10px; background: rgba(255,255,255,0.03); }
        .stat-box strong { display: block; font-size: 1.2rem; }
        .stat-box span { color: var(--muted); font-size: 0.82rem; }
        @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="hero">
            <div class="pill">Live Tracker</div>
            <h1>Game-day stats overview</h1>
            <p>Track players by role, with pitching, batting, and fielding stats shown where they belong.</p>
            <div style="margin-top: 10px;">
                <a href="{{ route('games.index') }}" style="display:inline-block; text-decoration:none; color:#07111f; background:var(--accent); padding:9px 12px; border-radius:999px; font-weight:700;">Open Scoreboard</a>
            </div>
        </div>

        @if($currentGame)
            <div class="card" style="margin-bottom:18px;">
                <h2>Current game</h2>
                <div class="row"><span>Match</span><strong>{{ $currentGame->homeTeam->abbreviation }} {{ $currentGame->home_score }} – {{ $currentGame->away_score }} {{ $currentGame->awayTeam->abbreviation }}</strong></div>
                <div class="row"><span>Inning</span><strong>{{ $currentGame->inning }} · {{ $currentGame->outs }} Outs</strong></div>
                <div class="row"><span>Count</span><strong>Balls {{ $currentGame->balls }} · Strikes {{ $currentGame->strikes }} · Fouls {{ $currentGame->foul_balls }}</strong></div>
                <div class="row"><span>Last play</span><strong>{{ $currentGame->last_play ?? 'Game ready' }}</strong></div>
                <div class="row"><span>Status</span><strong>{{ ucfirst($currentGame->status) }}</strong></div>
                <div class="row"><span>Lineup</span><strong>{{ $currentGame->home_lineup ? count($currentGame->home_lineup) : 0 }} home · {{ $currentGame->away_lineup ? count($currentGame->away_lineup) : 0 }} away</strong></div>
            </div>
        @else
            <div class="card" style="margin-bottom:18px;">
                <h2>Live tracker</h2>
                <p>No active game is available yet. Create a game from the dashboard and return here to watch the count, outs, and inning live.</p>
            </div>
        @endif

        <div class="grid">
            <div class="card">
                <h2>Players by team</h2>
                @if($players->isEmpty())
                    <p>No players yet.</p>
                @else
                    <div class="player-list">
                        @foreach($players as $player)
                            <div class="player-row">
                                <div class="player-meta">
                                    <strong>{{ $player->name }}</strong>
                                    <span>{{ $player->team->name ?? 'No team' }} • {{ $player->position }}</span>
                                </div>
                                <span class="stat-pill">{{ $player->position }}</span>
                            </div>
                            <div class="stats-grid">
                                @php
                                    $pitching = ['Games' => $player->pitching_games, 'W' => $player->pitching_wins, 'L' => $player->pitching_losses, 'ERA' => $player->pitching_era, 'SO' => $player->pitching_strikeouts];
                                    $batting = ['G' => $player->batting_games, 'AVG' => $player->batting_avg, 'HR' => $player->batting_home_runs, 'RBI' => $player->batting_rbi, 'R' => $player->batting_runs];
                                    $fielding = ['PO' => $player->fielding_putouts, 'A' => $player->fielding_assists, 'E' => $player->fielding_errors, 'FLD%' => $player->fielding_percentage];
                                    $stats = $player->position === 'SP' || $player->position === 'RP' ? $pitching : ($player->position === 'C' || $player->position === '1B' || $player->position === '2B' || $player->position === '3B' || $player->position === 'SS' || $player->position === 'LF' || $player->position === 'CF' || $player->position === 'RF' || $player->position === 'DH' ? $batting + $fielding : $batting + $fielding);
                                @endphp
                                @foreach($stats as $label => $value)
                                    <div class="row"><span>{{ $label }}</span><strong>{{ $value }}</strong></div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="card">
                <h2>Team snapshot</h2>
                @foreach($teams as $team)
                    <div class="team-card">
                        <div style="display:flex; justify-content:space-between; gap:10px; align-items:center;">
                            <strong>{{ $team->name }}</strong>
                            <span class="badge">{{ $team->players->count() }} players</span>
                        </div>
                        <div class="team-stats" style="margin-top: 10px;">
                            <div class="stat-box">
                                <strong>{{ $team->players->sum('batting_home_runs') }}</strong>
                                <span>HR</span>
                            </div>
                            <div class="stat-box">
                                <strong>{{ $team->players->sum('pitching_wins') }}</strong>
                                <span>Wins</span>
                            </div>
                            <div class="stat-box">
                                <strong>{{ $team->players->sum('fielding_putouts') }}</strong>
                                <span>PO</span>
                            </div>
                            <div class="stat-box">
                                <strong>{{ $team->players->sum('pitching_strikeouts') }}</strong>
                                <span>SO</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
