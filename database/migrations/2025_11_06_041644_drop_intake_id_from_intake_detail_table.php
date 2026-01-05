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
        Schema::table('intake_detail', function (Blueprint $table) {
            $table->dropForeign(['intake_id']);
            $table->dropColumn('intake_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intake_detail', function (Blueprint $table) {
            $table->foreignId('intake_id')->constrained('intake');
        });
    }
};
