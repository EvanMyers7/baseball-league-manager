<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    protected $fillable = [
        'team_id',
        'name',
        'position',
        'jersey_number',
        'image_url',
        'pitching_games',
        'pitching_wins',
        'pitching_losses',
        'pitching_era',
        'pitching_strikeouts',
        'pitching_innings_pitched',
        'batting_games',
        'batting_avg',
        'batting_home_runs',
        'batting_rbi',
        'batting_hits',
        'batting_runs',
        'batting_stolen_bases',
        'fielding_putouts',
        'fielding_assists',
        'fielding_errors',
        'fielding_percentage',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
