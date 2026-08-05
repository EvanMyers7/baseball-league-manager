<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --accent-2:#ff6b6b; --border:rgba(255,255,255,0.12); }
        * { box-sizing: border-box; }
        body { margin:0; font-family:Inter, Arial, sans-serif; background:linear-gradient(135deg, var(--bg), #12263d); color:var(--text); min-height:100vh; padding:24px; }
        .shell { max-width:1200px; margin:0 auto; }
        .card { background:rgba(15,28,44,0.92); border:1px solid var(--border); border-radius:24px; box-shadow:0 16px 40px rgba(0,0,0,0.2); padding:20px; }
        .scoreboard { display:grid; gap:16px; }
        .diamond { background:radial-gradient(circle at center, rgba(247,183,49,0.16), rgba(255,255,255,0.02)); border:1px solid rgba(255,255,255,0.08); border-radius:28px; padding:20px; display:grid; gap:12px; }
        .diamond-grid { display:grid; grid-template-columns:1.2fr 1fr 1.2fr; gap:10px; align-items:center; }
        .base { border:1px solid rgba(255,255,255,0.1); border-radius:16px; padding:12px; background:rgba(255,255,255,0.03); text-align:center; }
        .score-box { border:1px solid rgba(255,255,255,0.1); border-radius:16px; background:rgba(255,255,255,0.03); padding:12px; text-align:center; }
        .pill { display:inline-block; padding:4px 8px; border-radius:999px; background:rgba(247,183,49,0.16); color:var(--accent); font-size:0.8rem; font-weight:700; }
        .controls { display:flex; gap:10px; flex-wrap:wrap; margin-top:12px; }
        .controls form { display:inline; }
        .controls button { padding:10px 12px; border:none; border-radius:999px; background:var(--accent); color:#07111f; font-weight:700; cursor:pointer; }
        .muted { color:var(--muted); }
        .row { display:flex; justify-content:space-between; align-items:center; gap:8px; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.06); }
        .grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:16px; }
        @media (max-width:900px) { .diamond-grid { grid-template-columns:1fr; } .grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <a href="{{ route('games.index') }}" style="color:var(--text); text-decoration:none;">← Back to games</a>
            <div class="scoreboard" style="margin-top:12px;">
                <div style="display:flex; justify-content:space-between; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div>
                        <h1 style="margin:0;">{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}</h1>
                        <div class="muted">{{ $game->game_date }} • {{ $game->location ?? 'TBD' }}</div>
                    </div>
                    <div class="pill">{{ ucfirst($game->status) }}</div>
                </div>

                <div class="diamond">
                    <div class="diamond-grid">
                        <div class="score-box">
                            <div class="muted">Home</div>
                            <h2 style="margin:6px 0 0; font-size:2rem;">{{ $game->home_score }}</h2>
                            <div>{{ $game->homeTeam->name }}</div>
                        </div>
                        <div class="score-box">
                            <div class="muted">Inning / Outs</div>
                            <h2 style="margin:6px 0 0; font-size:2rem;">{{ $game->inning }} • {{ $game->outs }} Outs</h2>
                            <div>Balls {{ $game->balls }} • Strikes {{ $game->strikes }} • Fouls {{ $game->foul_balls }}</div>
                        </div>
                        <div class="score-box">
                            <div class="muted">Away</div>
                            <h2 style="margin:6px 0 0; font-size:2rem;">{{ $game->away_score }}</h2>
                            <div>{{ $game->awayTeam->name }}</div>
                        </div>
                    </div>
                    <div class="diamond-grid">
                        <div class="base">1B</div>
                        <div class="base">2B</div>
                        <div class="base">3B</div>
                    </div>
                </div>

                <div class="controls">
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="single">
                        <button type="submit">Single</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="double">
                        <button type="submit">Double</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="triple">
                        <button type="submit">Triple</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="home-run">
                        <button type="submit">Home Run</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="walk">
                        <button type="submit">Walk</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="strikeout">
                        <button type="submit">Strikeout</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="foul">
                        <button type="submit">Foul</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="away-run">
                        <button type="submit">Away Run</button>
                    </form>
                    <form method="POST" action="{{ route('games.score', $game) }}">
                        @csrf
                        <input type="hidden" name="event" value="inning-end">
                        <button type="submit">End Inning</button>
                    </form>
                </div>

                <div class="grid">
                    <div class="card">
                        <h3 style="margin-top:0;">Game Notes</h3>
                        <div class="row"><span>Last play</span><strong>{{ $game->last_play ?? 'No plays yet' }}</strong></div>
                        <div class="row"><span>Status</span><strong>{{ ucfirst($game->status) }}</strong></div>
                        <div class="row"><span>Location</span><strong>{{ $game->location ?? 'TBD' }}</strong></div>
                    </div>
                    <div class="card">
                        <h3 style="margin-top:0;">Roster</h3>
                        @foreach($game->players as $player)
                            <div class="row"><span>{{ $player->name }}</span><strong>{{ $player->position }}</strong></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
