<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TeamController::class, 'dashboard'])->name('home');

Route::get('/dashboard', [TeamController::class, 'dashboard'])->name('dashboard');
Route::get('/stats', [StatsController::class, 'index'])->name('stats.index');
Route::get('/live-tracker', [TrackerController::class, 'index'])->name('tracker.index');
Route::resource('games', GameController::class)->except(['edit', 'update', 'destroy']);
Route::post('/games/{game}/scoreboard', [GameController::class, 'score'])->name('games.score');
Route::resource('teams', TeamController::class)->except(['show']);
Route::resource('teams.players', PlayerController::class)->except(['show']);
