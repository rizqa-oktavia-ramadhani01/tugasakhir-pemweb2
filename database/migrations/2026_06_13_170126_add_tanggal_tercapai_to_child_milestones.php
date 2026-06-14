<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('child_milestones', function (Blueprint $table) {
            $table->date('tanggal_tercapai')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('child_milestones', function (Blueprint $table) {
            $table->dropColumn('tanggal_tercapai');
        });
    }
};