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
        Schema::table('student_list', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->date('dob')->nullable();
            $table->string('father_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->text('address')->nullable();
            $table->string('username')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_list', function (Blueprint $table) {
            //
        });
    }
};
