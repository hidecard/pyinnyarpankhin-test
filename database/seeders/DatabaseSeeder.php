<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed settings
        $this->call(SettingSeeder::class);

        // Seed events
        $this->call(EventSeeder::class);

        // Seed intakes and intake details
        $this->call(IntakeSeeder::class);

        // Seed admissions
        $this->call(AdmissionSeeder::class);
    }
}
