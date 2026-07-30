<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'name',
        'city',
        'abbreviation',
        'primary_color',
        'secondary_color',
        'stadium',
        'founded_year',
        'image_url',
        'pdf_url',
        'avatar_fit',
        'avatar_shape',
        'avatar_bg_color',
        'avatar_text_color',
        'avatar_offset_x',
        'avatar_offset_y',
        'avatar_scale',
    ];

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
}
