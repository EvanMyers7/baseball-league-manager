<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --border:rgba(255,255,255,0.12); }
        * { box-sizing: border-box; }
        body { margin:0; font-family:Inter, Arial, sans-serif; background:linear-gradient(135deg, var(--bg), #12263d); color:var(--text); min-height:100vh; padding:24px; }
        .shell { max-width:720px; margin:0 auto; }
        .card { background:rgba(15,28,44,0.92); border:1px solid var(--border); border-radius:20px; padding:20px; box-shadow:0 16px 40px rgba(0,0,0,0.2); }
        label { display:block; margin-top:0.8rem; font-weight:600; }
        input, select { width:100%; padding:0.75rem 0.85rem; margin-top:0.35rem; border:1px solid rgba(255,255,255,0.12); border-radius:10px; background:rgba(255,255,255,0.05); color:var(--text); }
        button { margin-top:1rem; padding:0.8rem 1rem; background:var(--accent); color:#07111f; border:none; border-radius:999px; font-weight:700; cursor:pointer; }
        a { color:var(--text); text-decoration:none; }
        .grid { display:grid; grid-template-columns:repeat(2, minmax(0,1fr)); gap:12px; }
        @media (max-width: 700px) { .grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <a href="{{ route('teams.players.index', $team) }}">← Back to roster</a>
            <h1 style="margin-top: 8px;">Edit Player</h1>
            <form method="POST" action="{{ route('teams.players.update', [$team, $player]) }}">
                @csrf
                @method('PUT')
                <div class="grid">
                    <div><label>Name</label><input name="name" value="{{ $player->name }}" required></div>
                    <div><label>Position</label><select name="position"><option {{ $player->position === 'SP' ? 'selected' : '' }}>SP</option><option {{ $player->position === 'RP' ? 'selected' : '' }}>RP</option><option {{ $player->position === 'C' ? 'selected' : '' }}>C</option><option {{ $player->position === '1B' ? 'selected' : '' }}>1B</option><option {{ $player->position === '2B' ? 'selected' : '' }}>2B</option><option {{ $player->position === '3B' ? 'selected' : '' }}>3B</option><option {{ $player->position === 'SS' ? 'selected' : '' }}>SS</option><option {{ $player->position === 'LF' ? 'selected' : '' }}>LF</option><option {{ $player->position === 'CF' ? 'selected' : '' }}>CF</option><option {{ $player->position === 'RF' ? 'selected' : '' }}>RF</option><option {{ $player->position === 'DH' ? 'selected' : '' }}>DH</option></select></div>
                    <div><label>Jersey Number</label><input type="number" name="jersey_number" value="{{ $player->jersey_number }}"></div>
                    <div><label>Image URL</label><input name="image_url" value="{{ $player->image_url }}"></div>
                </div>
                <h3 style="margin-bottom:6px;">Pitching</h3>
                <div class="grid">
                    <div><label>Games</label><input type="number" name="pitching_games" value="{{ $player->pitching_games }}"></div>
                    <div><label>Wins</label><input type="number" name="pitching_wins" value="{{ $player->pitching_wins }}"></div>
                    <div><label>Losses</label><input type="number" name="pitching_losses" value="{{ $player->pitching_losses }}"></div>
                    <div><label>ERA</label><input type="number" step="0.01" name="pitching_era" value="{{ $player->pitching_era }}"></div>
                    <div><label>Strikeouts</label><input type="number" name="pitching_strikeouts" value="{{ $player->pitching_strikeouts }}"></div>
                    <div><label>IP</label><input type="number" step="0.1" name="pitching_innings_pitched" value="{{ $player->pitching_innings_pitched }}"></div>
                </div>
                <h3 style="margin-bottom:6px;">Batting</h3>
                <div class="grid">
                    <div><label>Games</label><input type="number" name="batting_games" value="{{ $player->batting_games }}"></div>
                    <div><label>AVG</label><input type="number" step="0.001" name="batting_avg" value="{{ $player->batting_avg }}"></div>
                    <div><label>HR</label><input type="number" name="batting_home_runs" value="{{ $player->batting_home_runs }}"></div>
                    <div><label>RBI</label><input type="number" name="batting_rbi" value="{{ $player->batting_rbi }}"></div>
                    <div><label>Hits</label><input type="number" name="batting_hits" value="{{ $player->batting_hits }}"></div>
                    <div><label>Runs</label><input type="number" name="batting_runs" value="{{ $player->batting_runs }}"></div>
                    <div><label>SB</label><input type="number" name="batting_stolen_bases" value="{{ $player->batting_stolen_bases }}"></div>
                </div>
                <h3 style="margin-bottom:6px;">Fielding</h3>
                <div class="grid">
                    <div><label>Putouts</label><input type="number" name="fielding_putouts" value="{{ $player->fielding_putouts }}"></div>
                    <div><label>Assists</label><input type="number" name="fielding_assists" value="{{ $player->fielding_assists }}"></div>
                    <div><label>Errors</label><input type="number" name="fielding_errors" value="{{ $player->fielding_errors }}"></div>
                    <div><label>Fielding %</label><input type="number" step="0.001" name="fielding_percentage" value="{{ $player->fielding_percentage }}"></div>
                </div>
                <button type="submit">Update Player</button>
            </form>
        </div>
    </div>
</body>
</html>
