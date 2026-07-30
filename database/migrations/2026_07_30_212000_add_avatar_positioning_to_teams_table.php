<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->integer('avatar_offset_x')->nullable()->after('avatar_text_color');
            $table->integer('avatar_offset_y')->nullable()->after('avatar_offset_x');
            $table->decimal('avatar_scale', 3, 2)->nullable()->after('avatar_offset_y');
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['avatar_offset_x', 'avatar_offset_y', 'avatar_scale']);
        });
    }
};
