<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'game_date',
        'location',
        'inning',
        'outs',
        'balls',
        'strikes',
        'foul_balls',
        'home_score',
        'away_score',
        'status',
        'last_play',
        'home_lineup',
        'away_lineup',
    ];

    protected $casts = [
        'home_lineup' => 'array',
        'away_lineup' => 'array',
    ];

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class);
    }
}
