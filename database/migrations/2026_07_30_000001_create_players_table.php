<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('position', 10);
            $table->unsignedInteger('jersey_number')->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedInteger('pitching_games')->default(0);
            $table->unsignedInteger('pitching_wins')->default(0);
            $table->unsignedInteger('pitching_losses')->default(0);
            $table->decimal('pitching_era', 4, 2)->default(0);
            $table->unsignedInteger('pitching_strikeouts')->default(0);
            $table->decimal('pitching_innings_pitched', 4, 1)->default(0);
            $table->unsignedInteger('batting_games')->default(0);
            $table->decimal('batting_avg', 4, 3)->default(0);
            $table->unsignedInteger('batting_home_runs')->default(0);
            $table->unsignedInteger('batting_rbi')->default(0);
            $table->unsignedInteger('batting_hits')->default(0);
            $table->unsignedInteger('batting_runs')->default(0);
            $table->unsignedInteger('batting_stolen_bases')->default(0);
            $table->unsignedInteger('fielding_putouts')->default(0);
            $table->unsignedInteger('fielding_assists')->default(0);
            $table->unsignedInteger('fielding_errors')->default(0);
            $table->decimal('fielding_percentage', 4, 3)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
