<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('avatar_fit')->nullable()->after('image_url');
            $table->string('avatar_shape')->nullable()->after('avatar_fit');
            $table->string('avatar_bg_color')->nullable()->after('avatar_shape');
            $table->string('avatar_text_color')->nullable()->after('avatar_bg_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['avatar_fit', 'avatar_shape', 'avatar_bg_color', 'avatar_text_color']);
        });
    }
};
