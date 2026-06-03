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
        Schema::create('child_profiles', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->integer('age_years');

            $table->integer('age_months');

            $table->enum('development_status', [
                'On Track',
                'Needs Attention',
                'Advanced'
            ]);

            $table->enum('gender', [
                'boy',
                'girl'
            ]);

            $table->integer('target_vocabulary_size')->default(0);

            $table->integer('current_vocabulary_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_profiles');
    }
};
