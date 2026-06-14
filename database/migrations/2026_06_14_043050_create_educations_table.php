<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/xxxx_create_educations_table.php

        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('reading_time')->nullable();
            $table->text('excerpt');
            $table->string('banner_color')->default('#4F46E5');
            $table->string('badge')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->longText('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
