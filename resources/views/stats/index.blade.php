<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League Stats</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --border:rgba(255,255,255,0.12); }
        * { box-sizing:border-box; }
        body { margin:0; font-family:Inter, Arial, sans-serif; background:linear-gradient(135deg,#07111f,#12263d); color:var(--text); min-height:100vh; padding:24px; }
        .shell { max-width:1280px; margin:0 auto; }
        .card { background:rgba(15,28,44,0.92); border:1px solid var(--border); border-radius:24px; padding:20px; box-shadow:0 16px 40px rgba(0,0,0,0.2); }
        .topbar { display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:18px; }
        .controls { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:10px; margin-bottom:16px; }
        .controls input, .controls select, .controls button { width:100%; padding:10px 12px; border-radius:12px; border:1px solid rgba(255,255,255,0.1); background:rgba(255,255,255,0.05); color:var(--text); }
        .controls button { background:var(--accent); color:#07111f; font-weight:700; cursor:pointer; }
        table { width:100%; border-collapse:collapse; overflow:hidden; border-radius:16px; }
        th, td { padding:12px 10px; border-bottom:1px solid rgba(255,255,255,0.08); text-align:left; }
        th { color:var(--accent); font-size:0.8rem; text-transform:uppercase; letter-spacing:0.06em; }
        .pill { display:inline-block; padding:4px 8px; border-radius:999px; background:rgba(247,183,49,0.16); color:var(--accent); font-size:0.8rem; font-weight:700; }
        .pagination { display:flex; justify-content:center; gap:8px; margin-top:16px; flex-wrap:wrap; }
        .pagination a, .pagination span { padding:8px 12px; border-radius:999px; background:rgba(255,255,255,0.06); color:var(--text); text-decoration:none; }
        .pagination .active { background:var(--accent); color:#07111f; }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <div class="topbar">
                <div>
                    <h1 style="margin:0;">League Stats</h1>
                    <div style="color:var(--muted);">Search, filter, sort, and page through the full roster.</div>
                </div>
                <a href="{{ route('dashboard') }}" style="color:var(--text); text-decoration:none; padding:8px 12px; border:1px solid rgba(255,255,255,0.12); border-radius:999px;">← Dashboard</a>
            </div>

            <form method="GET" action="{{ route('stats.index') }}" class="controls">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search player or team">
                <select name="team">
                    <option value="">All teams</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ request('team') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                </select>
                <select name="position">
                    <option value="">All positions</option>
                    @foreach(['SP','RP','C','1B','2B','3B','SS','LF','CF','RF','DH'] as $position)
                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                    @endforeach
                </select>
                <select name="sort">
                    <option value="batting_home_runs" {{ request('sort') == 'batting_home_runs' ? 'selected' : '' }}>HR</option>
                    <option value="batting_avg" {{ request('sort') == 'batting_avg' ? 'selected' : '' }}>AVG</option>
                    <option value="pitching_wins" {{ request('sort') == 'pitching_wins' ? 'selected' : '' }}>Wins</option>
                    <option value="fielding_percentage" {{ request('sort') == 'fielding_percentage' ? 'selected' : '' }}>Fielding %</option>
                </select>
                <select name="direction">
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                </select>
                <button type="submit">Apply filters</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Team</th>
                        <th>Position</th>
                        <th>AVG</th>
                        <th>HR</th>
                        <th>Wins</th>
                        <th>Fielding %</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td><strong>{{ $player->name }}</strong><br><span style="color:var(--muted);">#{{ $player->jersey_number }}</span></td>
                            <td>{{ $player->team->name ?? '—' }}</td>
                            <td><span class="pill">{{ $player->position }}</span></td>
                            <td>{{ number_format($player->batting_avg, 3) }}</td>
                            <td>{{ $player->batting_home_runs }}</td>
                            <td>{{ $player->pitching_wins ?? 0 }}</td>
                            <td>{{ number_format($player->fielding_percentage, 3) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" style="text-align:center; padding:24px; color:var(--muted);">No players match the current filters.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $players->links() }}
            </div>
        </div>
    </div>
</body>
</html>
