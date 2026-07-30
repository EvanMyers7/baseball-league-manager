<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Game</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --border:rgba(255,255,255,0.12); }
        * { box-sizing: border-box; }
        body { margin:0; font-family:Inter, Arial, sans-serif; background:linear-gradient(135deg, var(--bg), #12263d); color:var(--text); min-height:100vh; padding:24px; }
        .shell { max-width:860px; margin:0 auto; }
        .card { background:rgba(15,28,44,0.92); border:1px solid var(--border); border-radius:20px; padding:20px; box-shadow:0 16px 40px rgba(0,0,0,0.2); }
        label { display:block; margin-top:0.8rem; font-weight:600; }
        input, select { width:100%; padding:0.75rem 0.85rem; margin-top:0.35rem; border:1px solid rgba(255,255,255,0.12); border-radius:10px; background:rgba(255,255,255,0.05); color:var(--text); }
        button { margin-top:1rem; padding:0.8rem 1rem; background:var(--accent); color:#07111f; border:none; border-radius:999px; font-weight:700; cursor:pointer; }
        a { color:var(--text); text-decoration:none; }
        .grid { display:grid; grid-template-columns:repeat(2, minmax(0,1fr)); gap:12px; }
        @media (max-width:700px) { .grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <a href="{{ route('games.index') }}">← Back to games</a>
            <h1 style="margin-top:8px;">Create Game</h1>
            <form method="POST" action="{{ route('games.store') }}">
                @csrf
                <div class="grid">
                    <div>
                        <label>Home Team</label>
                        <select name="home_team_id" required>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Away Team</label>
                        <select name="away_team_id" required>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <div>
                        <label>Game Date</label>
                        <input type="date" name="game_date" required>
                    </div>
                    <div>
                        <label>Location</label>
                        <input name="location" placeholder="Stadium name">
                    </div>
                </div>
                <div class="grid">
                    <div>
                        <label>Home Roster</label>
                        <select name="home_roster[]" multiple size="8">
                            @foreach($teams as $team)
                                <optgroup label="{{ $team->name }}">
                                    @foreach($team->players as $player)
                                        <option value="{{ $player->id }}">{{ $player->name }} ({{ $player->position }})</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Away Roster</label>
                        <select name="away_roster[]" multiple size="8">
                            @foreach($teams as $team)
                                <optgroup label="{{ $team->name }}">
                                    @foreach($team->players as $player)
                                        <option value="{{ $player->id }}">{{ $player->name }} ({{ $player->position }})</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit">Create Game</button>
            </form>
        </div>
    </div>
</body>
</html>
