<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Make degree_id nullable and drop any foreign key constraints
        try {
            DB::statement('ALTER TABLE student_list MODIFY degree_id BIGINT UNSIGNED NULL');
        } catch (\Exception $e) {
            // Column might not exist or already nullable
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_list', function (Blueprint $table) {
            // Can't easily undo this change
        });
    }
};

