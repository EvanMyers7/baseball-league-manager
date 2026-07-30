<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baseball League Manager</title>
    <style>
        :root {
            --bg: #07111f;
            --panel: #0f1c2c;
            --panel-2: #14263a;
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
            padding: 32px;
        }
        .shell { max-width: 1100px; margin: 0 auto; }
        .hero {
            background: linear-gradient(120deg, rgba(247,183,49,0.22), rgba(255,107,107,0.16));
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.28);
            margin-bottom: 20px;
        }
        .hero h1 { font-size: 2.2rem; margin: 0 0 8px; }
        .hero p { color: var(--muted); margin: 0 0 16px; font-size: 1rem; }
        .actions a {
            display: inline-block;
            text-decoration: none;
            color: #07111f;
            background: var(--accent);
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 700;
            margin-right: 10px;
            margin-top: 6px;
        }
        .actions a.secondary {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }
        .grid { display: grid; grid-template-columns: 1.3fr 0.7fr; gap: 20px; }
        .card {
            background: rgba(15, 28, 44, 0.92);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.2);
        }
        .card h2 { margin-top: 0; font-size: 1.2rem; }
        .team-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 12px; }
        .team-item {
            display: flex; align-items: center; gap: 14px;
            padding: 12px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
        }
        .team-media {
            width: 96px; height: 96px; flex-shrink: 0;
            border-radius: 22px; overflow: hidden;
            background: rgba(7,17,31,0.9);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
        }
        .team-media img {
            width: 100%; height: 100%; object-fit: contain; display: block;
            background: var(--panel);
        }
        .team-placeholder {
            color: #e8eef8; font-size: 0.85rem; text-align: center; padding: 8px;
        }
        .team-info { flex: 1; min-width: 0; }
        .team-info strong { font-size: 1.05rem; }
        .team-info span { color: #e8eef8; font-size: 0.95rem; }
        .pill {
            display: inline-block;
            background: rgba(247,183,49,0.16);
            color: var(--accent);
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }
        @media (max-width: 860px) { .grid { grid-template-columns: 1fr; } body { padding: 18px; } }
    </style>
</head>
<body>
    <div class="shell">
        <div class="hero">
            <div class="pill">League Control Center</div>
            <h1>Baseball League Manager</h1>
            <p>Track your roster of teams with a modern, game-day-ready experience.</p>
            <div class="actions">
                <a href="{{ route('teams.index') }}">View Teams</a>
                <a href="{{ route('tracker.index') }}">Live Tracker</a>
                <a href="{{ route('stats.index') }}">League Stats</a>
                <a href="{{ route('games.index') }}">Score Games</a>
                <a class="secondary" href="{{ route('teams.create') }}">Create Team</a>
            </div>
        </div>

        <div class="grid">
            <div class="card">
                <h2>Teams</h2>
                @if($teams->isEmpty())
                    <p>No teams yet.</p>
                @else
                    <ul class="team-list">
                        @foreach($teams as $team)
                            <li class="team-item">
                                <div class="team-media">
                                    @php($previewImage = $team->image_url ?: asset('images/team-placeholder.svg'))
                                    <img src="{{ $previewImage }}" alt="{{ $team->name }}" onerror="this.onerror=null;this.src='{{ asset('images/team-placeholder.svg') }}';" style="background: {{ $team->avatar_bg_color ?? '#0f172a' }}; color: {{ $team->avatar_text_color ?? '#f8fafc' }}; transform: translate({{ $team->avatar_offset_x ?? 0 }}px, {{ $team->avatar_offset_y ?? 0 }}px) scale({{ $team->avatar_scale ?? 1 }});">
                                </div>
                                <div class="team-info">
                                    <div style="display:flex; justify-content:space-between; align-items:center; gap:10px;">
                                        <div>
                                            <strong>{{ $team->name }}</strong><br>
                                            <span>{{ $team->city }} • {{ $team->abbreviation }}</span>
                                            @if($team->pdf_url)
                                                <div style="margin-top:4px;"><a href="{{ $team->pdf_url }}" target="_blank" rel="noopener" style="color:var(--accent); text-decoration:none; font-size:0.84rem;">Open PDF</a></div>
                                            @endif
                                        </div>
                                        <span class="pill">{{ $team->stadium ?? 'Ready to play' }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="card">
                <h2>League Snapshot</h2>
                <p style="color: var(--muted);">Your league is live. Add teams, manage identities, and keep your season organized.</p>
                <p><strong>{{ $teams->count() }}</strong> teams tracked</p>
                <p><strong>0</strong> games scheduled</p>
                <p><a href="{{ route('stats.index') }}" style="color:var(--accent); text-decoration:none; font-weight:700;">Open full stats hub</a></p>
            </div>
        </div>
    </div>
</body>
</html>
