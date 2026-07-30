<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Team</title>
    <style>
        :root { --bg:#07111f; --panel:#0f1c2c; --text:#f4f7fb; --muted:#8aa0b8; --accent:#f7b731; --border:rgba(255,255,255,0.12); }
        *{box-sizing:border-box;} body{margin:0;font-family:Inter,Arial,sans-serif;background:linear-gradient(135deg,#07111f,#12263d);color:var(--text);min-height:100vh;padding:32px;}
        .shell{max-width:640px;margin:0 auto;} .card{background:rgba(15,28,44,0.92);border:1px solid var(--border);border-radius:20px;padding:24px;box-shadow:0 16px 40px rgba(0,0,0,0.2);position:relative;} .header-row{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:16px;} .header-copy{flex:1;} .avatar-preview{width:116px;height:116px;flex-shrink:0;border:1px solid var(--border);border-radius:24px;overflow:hidden;background:#0f172a;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 24px rgba(0,0,0,0.25);padding:10px;} .avatar-preview img{width:100%;height:100%;object-fit:contain;display:block;object-position:center;} a{color:var(--text);text-decoration:none;} label{display:block;margin-top:0.9rem;font-weight:600;} input, select{width:100%;padding:0.75rem 0.85rem;margin-top:0.35rem;border:1px solid rgba(255,255,255,0.12);border-radius:10px;background:rgba(255,255,255,0.05);color:var(--text);} button{margin-top:1.1rem;padding:0.8rem 1rem;background:var(--accent);color:#07111f;border:none;border-radius:999px;cursor:pointer;font-weight:700;} .modal{display:none;position:fixed;inset:0;background:rgba(2,6,23,0.86);align-items:center;justify-content:center;padding:24px;z-index:10;} .modal.open{display:flex;} .modal-card{background:var(--panel);border:1px solid var(--border);border-radius:24px;padding:20px;max-width:760px;width:100%;} .preview-box{width:min(320px, calc(100vw - 48px));aspect-ratio:1/1;max-height:min(320px, 70vh);border:1px dashed rgba(255,255,255,0.16);border-radius:24px;overflow:hidden;position:relative;background:#0f172a;display:flex;align-items:center;justify-content:center;margin:10px auto 0;padding:16px;} .preview-box img{width:100%;height:100%;object-fit:contain;display:block;cursor:grab;transition:transform 0.1s ease;transform-origin:center center;object-position:center;}
    </style>
</head>
<body>
    <div class="shell">
        <div class="card">
            <div class="header-row">
                <div class="header-copy">
                    <a href="{{ route('teams.index') }}">← Back to teams</a>
                    <h1 style="margin-top: 0;">Edit Team</h1>
                    <button type="button" onclick="openEditor()" style="margin-top:0;">Open logo editor</button>
                </div>
                <div class="avatar-preview">
                    @php($previewImage = $team->image_url ?: asset('images/team-placeholder.svg'))
                    <img src="{{ $previewImage }}" alt="{{ $team->name }}" onerror="this.onerror=null;this.src='{{ asset('images/team-placeholder.svg') }}';" style="background: {{ $team->avatar_bg_color ?? '#0f172a' }}; border-radius: 16px;">
                </div>
            </div>

            <form method="POST" action="{{ route('teams.update', $team) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label>Team name</label>
                <input type="text" name="name" value="{{ old('name', $team->name) }}" required>

                <label>City</label>
                <input type="text" name="city" value="{{ old('city', $team->city) }}" required>

                <label>Abbreviation</label>
                <input type="text" name="abbreviation" maxlength="5" value="{{ old('abbreviation', $team->abbreviation) }}" required>

                <label>Primary color</label>
                <input type="text" name="primary_color" value="{{ old('primary_color', $team->primary_color) }}" required>

                <label>Secondary color</label>
                <input type="text" name="secondary_color" value="{{ old('secondary_color', $team->secondary_color) }}">

                <label>Stadium</label>
                <input type="text" name="stadium" value="{{ old('stadium', $team->stadium) }}">

                <label>Founded year</label>
                <input type="number" name="founded_year" min="1800" max="2100" value="{{ old('founded_year', $team->founded_year) }}">

                <label>Image URL</label>
                <input type="url" name="image_url" value="{{ old('image_url', $team->image_url) }}" placeholder="https://example.com/team.jpg">

                <label>Upload logo file</label>
                <input type="file" name="logo_file" accept="image/*">

                <label>Team PDF URL</label>
                <input type="url" name="pdf_url" value="{{ old('pdf_url', $team->pdf_url) }}" placeholder="https://example.com/roster.pdf">

                <label>Avatar fit</label>
                <select name="avatar_fit">
                    <option value="cover" {{ old('avatar_fit', $team->avatar_fit) === 'cover' ? 'selected' : '' }}>Cover</option>
                    <option value="contain" {{ old('avatar_fit', $team->avatar_fit) === 'contain' ? 'selected' : '' }}>Contain</option>
                    <option value="fill" {{ old('avatar_fit', $team->avatar_fit) === 'fill' ? 'selected' : '' }}>Fill</option>
                </select>

                <label>Avatar shape</label>
                <select name="avatar_shape">
                    <option value="square" {{ old('avatar_shape', $team->avatar_shape) === 'square' ? 'selected' : '' }}>Square</option>
                    <option value="rounded" {{ old('avatar_shape', $team->avatar_shape) === 'rounded' ? 'selected' : '' }}>Rounded</option>
                    <option value="circle" {{ old('avatar_shape', $team->avatar_shape) === 'circle' ? 'selected' : '' }}>Circle</option>
                </select>

                <label>Avatar background</label>
                <input type="color" name="avatar_bg_color" value="{{ old('avatar_bg_color', $team->avatar_bg_color ?? '#0f172a') }}">

                <label>Avatar text color</label>
                <input type="color" name="avatar_text_color" value="{{ old('avatar_text_color', $team->avatar_text_color ?? '#f8fafc') }}">

                <input type="hidden" name="avatar_offset_x" id="avatar_offset_x" value="{{ old('avatar_offset_x', $team->avatar_offset_x ?? 0) }}">
                <input type="hidden" name="avatar_offset_y" id="avatar_offset_y" value="{{ old('avatar_offset_y', $team->avatar_offset_y ?? 0) }}">
                <input type="hidden" name="avatar_scale" id="avatar_scale" value="{{ old('avatar_scale', $team->avatar_scale ?? 1) }}">

                <button type="submit">Update team</button>
            </form>
        </div>
    </div>

    <div id="editorModal" class="modal">
        <div class="modal-card">
            <h3 style="margin-top:0;">Logo editor</h3>
            <div class="preview-box" id="previewBox" style="background: {{ $team->avatar_bg_color ?? '#0f172a' }};">
                @php($previewImage = $team->image_url ?: asset('images/team-placeholder.svg'))
                <img id="editorImage" src="{{ $previewImage }}" alt="{{ $team->name }}" onerror="this.onerror=null;this.src='{{ asset('images/team-placeholder.svg') }}';" style="transform: translate({{ $team->avatar_offset_x ?? 0 }}px, {{ $team->avatar_offset_y ?? 0 }}px) scale({{ $team->avatar_scale ?? 1 }}); border-radius: 18px;">
            </div>
            <div style="margin-top:12px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <label style="display:inline-flex; align-items:center; gap:6px;">Scale <input type="range" id="scaleRange" min="0.8" max="2.5" step="0.05" value="{{ $team->avatar_scale ?? 1 }}" oninput="setScale(this.value)"></label>
                <span style="color:var(--muted);">Drag the logo to position it, then confirm to save the final look.</span>
                <button type="button" onclick="closeEditor()">Done</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('editorModal');
        const image = document.getElementById('editorImage');
        const xInput = document.getElementById('avatar_offset_x');
        const yInput = document.getElementById('avatar_offset_y');
        const scaleInput = document.getElementById('avatar_scale');
        let dragging = false;
        let offset = {x:0,y:0};

        function openEditor() {
            modal.classList.add('open');
        }
        function closeEditor() {
            modal.classList.remove('open');
        }
        function setScale(value) {
            if (image) {
                image.style.transform = `translate(${xInput.value}px, ${yInput.value}px) scale(${value})`;
                scaleInput.value = value;
            }
        }
        if (image) {
            image.addEventListener('pointerdown', (event) => {
                dragging = true;
                offset = {x: event.clientX - Number(xInput.value || 0), y: event.clientY - Number(yInput.value || 0)};
                image.style.cursor = 'grabbing';
            });
            window.addEventListener('pointermove', (event) => {
                if (!dragging) return;
                const nextX = event.clientX - offset.x;
                const nextY = event.clientY - offset.y;
                xInput.value = nextX;
                yInput.value = nextY;
                image.style.transform = `translate(${nextX}px, ${nextY}px) scale(${scaleInput.value || 1})`;
            });
            window.addEventListener('pointerup', () => {
                dragging = false;
                image.style.cursor = 'grab';
            });
        }
    </script>
</body>
</html>
