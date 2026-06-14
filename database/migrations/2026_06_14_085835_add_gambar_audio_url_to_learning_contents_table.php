<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('learning_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('learning_contents', 'gambar_url')) {
                $table->string('gambar_url')->nullable()->after('gambar');
            }
            if (!Schema::hasColumn('learning_contents', 'audio_url')) {
                $table->string('audio_url')->nullable()->after('audio');
            }
        });
    }

    public function down(): void
    {
        Schema::table('learning_contents', function (Blueprint $table) {
            $table->dropColumn(['gambar_url', 'audio_url']);
        });
    }
};