<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_team_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('away_team_id')->constrained('teams')->cascadeOnDelete();
            $table->date('game_date');
            $table->string('location')->nullable();
            $table->unsignedInteger('inning')->default(1);
            $table->unsignedInteger('outs')->default(0);
            $table->unsignedInteger('balls')->default(0);
            $table->unsignedInteger('strikes')->default(0);
            $table->unsignedInteger('home_score')->default(0);
            $table->unsignedInteger('away_score')->default(0);
            $table->string('status')->default('scheduled');
            $table->string('last_play')->nullable();
            $table->json('home_lineup')->nullable();
            $table->json('away_lineup')->nullable();
            $table->timestamps();
        });

        Schema::create('game_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_player');
        Schema::dropIfExists('games');
    }
};
