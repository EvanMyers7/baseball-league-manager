<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $team->name }} Roster</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --border:rgba(255,255,255,0.12); }
        * { box-sizing: border-box; }
        body { margin:0; font-family:Inter, Arial, sans-serif; background:linear-gradient(135deg, var(--bg), #12263d); color:var(--text); min-height:100vh; padding:24px; }
        .shell { max-width:1080px; margin:0 auto; }
        .topbar, .card { background:rgba(15,28,44,0.92); border:1px solid var(--border); border-radius:20px; box-shadow:0 16px 40px rgba(0,0,0,0.2); }
        .topbar { padding:16px 20px; display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:16px; }
        .topbar a { color:var(--text); text-decoration:none; padding:8px 12px; border-radius:999px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.08); }
        .card { padding:20px; }
        .player-list { display:grid; gap:12px; }
        .player-item { display:flex; justify-content:space-between; gap:14px; align-items:center; padding:14px; border:1px solid rgba(255,255,255,0.08); border-radius:16px; background:rgba(255,255,255,0.03); }
        .pill { display:inline-block; padding:4px 8px; border-radius:999px; background:rgba(247,183,49,0.16); color:var(--accent); font-size:0.8rem; font-weight:700; }
        .muted { color:var(--muted); }
        .actions a, .actions button { display:inline-block; text-decoration:none; color:#07111f; background:var(--accent); padding:9px 12px; border-radius:999px; font-weight:700; border:none; cursor:pointer; margin-left:6px; }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div>
                <h1 style="margin:0; font-size:1.3rem;">{{ $team->name }} Roster</h1>
                <div class="muted">Manage every player and their stats</div>
            </div>
            <div class="actions">
                <a href="{{ route('teams.index') }}">Back to Teams</a>
                <a href="{{ route('teams.players.create', $team) }}">Add Player</a>
            </div>
        </div>

        <div class="card">
            @if (session('status'))
                <p style="color: var(--accent);"><strong>{{ session('status') }}</strong></p>
            @endif
            @if($team->players->isEmpty())
                <p>No players yet.</p>
            @else
                <div class="player-list">
                    @foreach($team->players as $player)
                        <div class="player-item">
                            <div>
                                <strong>{{ $player->name }}</strong><br>
                                <span class="muted">#{{ $player->jersey_number ?? '—' }} • {{ $player->position }}</span>
                            </div>
                            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                                <span class="pill">{{ $player->position }}</span>
                                <a href="{{ route('teams.players.edit', [$team, $player]) }}" style="text-decoration:none; color:var(--accent);">Edit</a>
                                <form method="POST" action="{{ route('teams.players.destroy', [$team, $player]) }}" onsubmit="return confirm('Delete this player?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="margin:0; padding:0; background:none; color:#ff7b7b; border:none; cursor:pointer; font-weight:700;">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
</html>
