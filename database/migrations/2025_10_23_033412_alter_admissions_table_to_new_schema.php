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
        Schema::table('admissions', function (Blueprint $table) {
            $table->renameColumn('applicant_name', 'admissions_name');
            $table->dropForeign(['major_id']);
            $table->dropForeign(['degree_id']);
            $table->dropColumn(['major_id', 'degree_id', 'application_details', 'is_approved']);
            $table->foreignId('department_id')->constrained('department');
            $table->integer('minimum_gpa');
            $table->string('transcripts', 30);
            $table->integer('recommendation');
            $table->string('edu_degree', 30);
            $table->integer('sop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn(['department_id', 'minimum_gpa', 'transcripts', 'recommendation', 'edu_degree', 'sop']);
            $table->renameColumn('admissions_name', 'applicant_name');
            $table->foreignId('major_id')->constrained('major');
            $table->foreignId('degree_id')->constrained('degree');
            $table->text('application_details');
            $table->boolean('is_approved')->default(false);
        });
    }
};
