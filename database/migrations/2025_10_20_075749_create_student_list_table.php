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
        Schema::create('student_list', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('student_id');
            $table->string('photo')->nullable();
            $table->date('dob')->nullable();
            $table->string('father_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->text('address')->nullable();
            $table->string('username')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_list');
    }
};
