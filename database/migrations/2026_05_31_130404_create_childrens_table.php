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
        Schema::create('children', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('nama_anak');
            $table->integer('usia_anak');
            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->string('tingkat_kemampuan_bicara')->nullable();
            $table->text('respon_verbal')->nullable();
            $table->text('riwayat_perkembangan_bahasa')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
