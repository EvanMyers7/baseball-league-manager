<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'teams' => Team::latest()->get(),
            'gamesCount' => Game::count(),
        ]);
    }

    public function index()
    {
        return view('teams.index', [
            'teams' => Team::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:5'],
            'primary_color' => ['required', 'string', 'max:255'],
            'secondary_color' => ['nullable', 'string', 'max:255'],
            'stadium' => ['nullable', 'string', 'max:255'],
            'founded_year' => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'pdf_url' => ['nullable', 'string', 'max:255'],
            'logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'avatar_fit' => ['nullable', 'string', 'max:20'],
            'avatar_shape' => ['nullable', 'string', 'max:20'],
            'avatar_bg_color' => ['nullable', 'string', 'max:20'],
            'avatar_text_color' => ['nullable', 'string', 'max:20'],
            'avatar_offset_x' => ['nullable', 'numeric'],
            'avatar_offset_y' => ['nullable', 'numeric'],
            'avatar_scale' => ['nullable', 'numeric'],
        ]);

        $validated['image_url'] = $this->storeLogo($request, $validated['name'], $validated['image_url'] ?? null);

        Team::create($validated);

        return redirect()->route('teams.index')->with('status', 'Team created successfully.');
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:5'],
            'primary_color' => ['required', 'string', 'max:255'],
            'secondary_color' => ['nullable', 'string', 'max:255'],
            'stadium' => ['nullable', 'string', 'max:255'],
            'founded_year' => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'pdf_url' => ['nullable', 'string', 'max:255'],
            'logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'avatar_fit' => ['nullable', 'string', 'max:20'],
            'avatar_shape' => ['nullable', 'string', 'max:20'],
            'avatar_bg_color' => ['nullable', 'string', 'max:20'],
            'avatar_text_color' => ['nullable', 'string', 'max:20'],
            'avatar_offset_x' => ['nullable', 'numeric'],
            'avatar_offset_y' => ['nullable', 'numeric'],
            'avatar_scale' => ['nullable', 'numeric'],
        ]);

        $validated['image_url'] = $this->storeLogo($request, $validated['name'], $team->image_url);

        $team->update($validated);

        return redirect()->route('teams.index')->with('status', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')->with('status', 'Team deleted successfully.');
    }

    protected function storeLogo(Request $request, ?string $name = null, ?string $existingImage = null): ?string
    {
        if ($request->hasFile('logo_file')) {
            $file = $request->file('logo_file');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = Str::slug($name ?? 'team') . '-' . time() . '.' . $extension;
            $path = $file->storeAs('uploads/teams', $filename, 'public');

            return '/storage/' . $path;
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return $existingImage;
    }
}
