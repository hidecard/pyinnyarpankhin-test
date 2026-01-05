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
        // Drop foreign key constraint if exists
        Schema::table('student_list', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
        });

        // Then drop the column
        Schema::table('student_list', function (Blueprint $table) {
            if (Schema::hasColumn('student_list', 'major_id')) {
                $table->dropColumn('major_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_list', function (Blueprint $table) {
            $table->unsignedBigInteger('major_id')->nullable();
        });
    }
};

