<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('student_list', function (Blueprint $table) {
            if (Schema::hasColumn('student_list', 'major_id')) {
                $table->dropColumn('major_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('student_list', function (Blueprint $table) {
            if (!Schema::hasColumn('student_list', 'major_id')) {
                $table->unsignedBigInteger('major_id')->nullable();

                // add FK back ONLY if needed
                // $table->foreign('major_id')
                //       ->references('id')
                //       ->on('majors')
                //       ->nullOnDelete();
            }
        });
    }
};
