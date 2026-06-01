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
        Schema::create('child_milestones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                ->constrained('children')
                ->onDelete('cascade');

            $table->foreignId('milestone_id')
                ->constrained('milestones')
                ->onDelete('cascade');

            $table->enum('status', [
                'belum_tercapai',
                'tercapai'
            ])->default('belum_tercapai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_milestones');
    }
};
