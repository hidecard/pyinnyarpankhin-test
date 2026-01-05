<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite doesn't support dropping foreign keys easily, so we'll recreate the table
        // First, drop the existing foreign keys and table
        Schema::disableForeignKeyConstraints();

        // Drop the existing table
        Schema::dropIfExists('degree_major');

        // Recreate the table with CASCADE delete
        Schema::create('degree_major', function ($table) {
            $table->foreignId('degree_id')->constrained('degree')->onDelete('cascade');
            $table->foreignId('major_id')->constrained('major')->onDelete('cascade');
            $table->primary(['degree_id', 'major_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('degree_major');

        Schema::create('degree_major', function ($table) {
            $table->foreignId('degree_id')->constrained('degree');
            $table->foreignId('major_id')->constrained('major');
            $table->primary(['degree_id', 'major_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }
};

