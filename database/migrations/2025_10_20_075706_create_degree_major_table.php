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
        Schema::create('degree_major', function (Blueprint $table) {
            $table->foreignId('degree_id')->constrained('degree');
            $table->foreignId('major_id')->constrained('major');
            $table->primary(['degree_id', 'major_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('degree_major');
    }
};
