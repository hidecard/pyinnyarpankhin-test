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
        Schema::table('degree', function ($table) {
            // Drop the existing foreign key
            $table->dropForeign(['duration_id']);

            // Add the foreign key with CASCADE
            $table->foreign('duration_id')
                ->references('id')
                ->on('duration')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('degree', function ($table) {
            $table->dropForeign(['duration_id']);

            $table->foreign('duration_id')
                ->references('id')
                ->on('duration');
        });
    }
};

