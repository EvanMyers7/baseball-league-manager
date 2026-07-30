<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team</title>
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
        .shell { max-width: 640px; margin: 0 auto; }
        .card {
            background: rgba(15, 28, 44, 0.92);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.2);
        }
        .toplink { color: var(--text); text-decoration: none; display: inline-block; margin-bottom: 14px; }
        label { display: block; margin-top: 0.9rem; font-weight: 600; color: var(--text); }
        input {
            width: 100%; padding: 0.75rem 0.85rem; margin-top: 0.35rem;
            border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; background: rgba(255,255,255,0.05); color: var(--text);
        }
        button {
            margin-top: 1.1rem; padding: 0.8rem 1rem; background: var(--accent); color: #07111f; border: none; border-radius: 999px; cursor: pointer; font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <a class="toplink" href="{{ route('teams.index') }}">← Back to teams</a>
            <h1 style="margin-top: 0;">Create Team</h1>

            <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
                @csrf
                <label>Team name</label>
                <input type="text" name="name" required>

                <label>City</label>
                <input type="text" name="city" required>

                <label>Abbreviation</label>
                <input type="text" name="abbreviation" maxlength="5" required>

                <label>Primary color</label>
                <input type="text" name="primary_color" required>

                <label>Secondary color</label>
                <input type="text" name="secondary_color">

                <label>Stadium</label>
                <input type="text" name="stadium">

                <label>Founded year</label>
                <input type="number" name="founded_year" min="1800" max="2100">

                <label>Image URL</label>
                <input type="url" name="image_url" placeholder="https://example.com/team.jpg">

                <label>Upload logo file</label>
                <input type="file" name="logo_file" accept="image/*">

                <label>Team PDF URL</label>
                <input type="url" name="pdf_url" placeholder="https://example.com/roster.pdf">

                <label>Avatar fit</label>
                <select name="avatar_fit">
                    <option value="cover">Cover</option>
                    <option value="contain">Contain</option>
                    <option value="fill">Fill</option>
                </select>

                <label>Avatar shape</label>
                <select name="avatar_shape">
                    <option value="square">Square</option>
                    <option value="rounded">Rounded</option>
                    <option value="circle">Circle</option>
                </select>

                <label>Avatar background</label>
                <input type="color" name="avatar_bg_color" value="#0f172a">

                <label>Avatar text color</label>
                <input type="color" name="avatar_text_color" value="#f8fafc">

                <button type="submit">Save team</button>
            </form>
        </div>
    </div>
</body>
</html>
