<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
    <style>
        :root {
            --bg: #07111f;
            --panel: #0f1c2c;
            --text: #f4f7fb;
            --muted: #8aa0b8;
            --accent: #f7b731;
            --border: rgba(255,255,255,0.12);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: linear-gradient(135deg, #07111f, #12263d);
            color: var(--text);
            min-height: 100vh;
            padding: 32px;
        }
        .shell { max-width: 960px; margin: 0 auto; }
        .topbar {
            display: flex; justify-content: space-between; align-items: center; gap: 12px;
            margin-bottom: 20px;
            padding: 16px 20px;
            background: rgba(15, 28, 44, 0.92);
            border: 1px solid var(--border);
            border-radius: 16px;
        }
        .topbar a {
            color: var(--text);
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .card {
            background: rgba(15, 28, 44, 0.92);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.2);
        }
        .team-list { list-style: none; padding: 0; margin: 0; display: grid; gap: 16px; }
        .team-item {
            display: flex; align-items: center; gap: 16px;
            padding: 14px;
            border-radius: 20px; border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(90deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
        }
        .team-media {
            width: 120px; height: 120px; flex-shrink: 0;
            border-radius: 24px; overflow: hidden;
            background: rgba(7,17,31,0.9);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            padding: 8px;
        }
        .team-media img {
            width: 100%; height: 100%; object-fit: contain; display: block;
            background: var(--panel);
            border-radius: 16px;
        }
        .team-placeholder {
            color: #e8eef8; font-size: 0.9rem; text-align: center; padding: 10px;
        }
        .team-info { flex: 1; min-width: 0; }
        .team-info strong { font-size: 1.08rem; }
        .team-info span { color: #e8eef8; }
        .pill { display: inline-block; background: rgba(247,183,49,0.16); color: var(--accent); padding: 4px 8px; border-radius: 999px; font-size: 0.8rem; font-weight: 700; }
    </style>
</head>
<body>
    <div class="shell">
        <div class="topbar">
            <div>
                <h1 style="margin: 0; font-size: 1.35rem;">Teams</h1>
                <div style="color: var(--muted);">Manage your league roster</div>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('tracker.index') }}">Live Tracker</a>
                <a href="{{ route('teams.create') }}">Create Team</a>
            </div>
        </div>

        <div class="card">
            @if (session('status'))
                <p style="margin-top: 0; color: var(--accent);"><strong>{{ session('status') }}</strong></p>
            @endif

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
                                <div style="display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:10px;">
                                    <div>
                                        <strong>{{ $team->name }}</strong><br>
                                        <span>{{ $team->city }} • {{ $team->abbreviation }}</span>
                                    </div>
                                    <span class="pill">{{ $team->stadium ?? 'Ready' }}</span>
                                </div>
                                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                    <a href="{{ route('teams.players.index', $team) }}" style="text-decoration:none; color:var(--accent);">Roster</a>
                                    @if($team->pdf_url)
                                        <a href="{{ $team->pdf_url }}" target="_blank" rel="noopener" style="text-decoration:none; color:var(--accent);">PDF</a>
                                    @endif
                                    <a href="{{ route('teams.edit', $team) }}" style="text-decoration:none; color:var(--accent);">Edit</a>
                                    <form method="POST" action="{{ route('teams.destroy', $team) }}" onsubmit="return confirm('Delete this team?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="margin:0; padding:0; background:none; color:#ff7b7b; border:none; cursor:pointer; font-weight:700;">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</body>
</html>
