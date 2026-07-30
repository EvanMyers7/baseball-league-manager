<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Day</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --border:rgba(255,255,255,0.12); }
        * { box-sizing: border-box; }
        body { margin:0; font-family:Inter, Arial, sans-serif; background:linear-gradient(135deg, var(--bg), #12263d); color:var(--text); min-height:100vh; padding:24px; }
        .shell { max-width:1100px; margin:0 auto; }
        .topbar, .card { background:rgba(15,28,44,0.92); border:1px solid var(--border); border-radius:24px; box-shadow:0 16px 40px rgba(0,0,0,0.2); }
        .topbar { padding:18px 20px; display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:16px; }
        .topbar a { color:var(--text); text-decoration:none; padding:8px 12px; border-radius:999px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.08); }
        .card { padding:20px; margin-bottom:14px; }
        .game-list { display:grid; gap:12px; }
        .game-item { padding:16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)); display:flex; justify-content:space-between; align-items:center; gap:12px; }
        .pill { display:inline-block; padding:4px 8px; border-radius:999px; background:rgba(247,183,49,0.16); color:var(--accent); font-size:0.78rem; font-weight:700; }
        .muted { color:var(--muted); }
        .btn { display:inline-block; text-decoration:none; color:#07111f; background:var(--accent); padding:9px 12px; border-radius:999px; font-weight:700; }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div>
                <h1 style="margin:0; font-size:1.3rem;">Game Day</h1>
                <div class="muted">Create games, set rosters, and score the action live.</div>
            </div>
            <div>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('games.create') }}">Create Game</a>
            </div>
        </div>

        <div class="card">
            @if (session('status'))
                <p style="color: var(--accent);"><strong>{{ session('status') }}</strong></p>
            @endif
            @if($games->isEmpty())
                <p>No games yet.</p>
            @else
                <div class="game-list">
                    @foreach($games as $game)
                        <div class="game-item">
                            <div>
                                <strong>{{ $game->homeTeam->name ?? 'Home' }} vs {{ $game->awayTeam->name ?? 'Away' }}</strong><br>
                                <span class="muted">{{ $game->game_date }} • {{ $game->location ?? 'TBD' }}</span>
                            </div>
                            <div style="text-align:right;">
                                <div class="pill">{{ ucfirst($game->status) }}</div>
                                <div style="margin-top:6px;">
                                    <a class="btn" href="{{ route('games.show', $game) }}">Open Scoreboard</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
</html>
