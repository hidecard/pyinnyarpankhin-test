<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate tables to avoid duplicates
        DB::table('intake_detail')->truncate();
        DB::table('intake')->truncate();

        // Seed Intake table
        DB::table('intake')->insert([
            ['name' => 'Fall Intake', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Spring Intake', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Summer Intake', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed IntakeDetail table with all events for each intake
        DB::table('intake_detail')->insert([
            // Fall Intake (August/September start)
            [
                'event_name' => 'Applications Open',
                'intake_id' => 1,
                'start_date' => '2025-06-01',
                'end_date' => '2025-06-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Priority Deadline',
                'intake_id' => 1,
                'start_date' => '2025-07-15',
                'end_date' => '2025-07-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Deadline',
                'intake_id' => 1,
                'start_date' => '2025-08-15',
                'end_date' => '2025-08-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Entrance Exams',
                'intake_id' => 1,
                'start_date' => '2025-08-20',
                'end_date' => '2025-08-20',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Decision Notification',
                'intake_id' => 1,
                'start_date' => '2025-08-30',
                'end_date' => '2025-08-30',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Orientation',
                'intake_id' => 1,
                'start_date' => '2025-09-01',
                'end_date' => '2025-09-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Spring Intake (January start)
            [
                'event_name' => 'Applications Open',
                'intake_id' => 2,
                'start_date' => '2025-10-01',
                'end_date' => '2025-10-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Priority Deadline',
                'intake_id' => 2,
                'start_date' => '2025-11-15',
                'end_date' => '2025-11-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Deadline',
                'intake_id' => 2,
                'start_date' => '2025-12-15',
                'end_date' => '2025-12-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Entrance Exams',
                'intake_id' => 2,
                'start_date' => '2025-12-20',
                'end_date' => '2025-12-20',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Decision Notification',
                'intake_id' => 2,
                'start_date' => '2026-01-05',
                'end_date' => '2026-01-05',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Orientation',
                'intake_id' => 2,
                'start_date' => '2026-01-10',
                'end_date' => '2026-01-10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Summer Intake (May start)
            [
                'event_name' => 'Applications Open',
                'intake_id' => 3,
                'start_date' => '2026-01-01',
                'end_date' => '2026-01-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Priority Deadline',
                'intake_id' => 3,
                'start_date' => '2026-02-15',
                'end_date' => '2026-02-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Deadline',
                'intake_id' => 3,
                'start_date' => '2026-04-01',
                'end_date' => '2026-04-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Entrance Exams',
                'intake_id' => 3,
                'start_date' => '2026-04-15',
                'end_date' => '2026-04-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Decision Notification',
                'intake_id' => 3,
                'start_date' => '2026-04-30',
                'end_date' => '2026-04-30',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'event_name' => 'Orientation',
                'intake_id' => 3,
                'start_date' => '2026-05-05',
                'end_date' => '2026-05-05',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Seed Tuition table (assuming degree IDs from DatabaseSeeder)
        DB::table('tuition')->insert([
            ['degree_id' => 1, 'fees' => 5000, 'created_at' => now(), 'updated_at' => now()], // BSc
            ['degree_id' => 2, 'fees' => 4500, 'created_at' => now(), 'updated_at' => now()], // BA
            ['degree_id' => 3, 'fees' => 5500, 'created_at' => now(), 'updated_at' => now()], // BEng
            ['degree_id' => 4, 'fees' => 8000, 'created_at' => now(), 'updated_at' => now()], // MBA
            ['degree_id' => 5, 'fees' => 7000, 'created_at' => now(), 'updated_at' => now()], // MSc
            ['degree_id' => 6, 'fees' => 7500, 'created_at' => now(), 'updated_at' => now()], // MEng
            ['degree_id' => 7, 'fees' => 10000, 'created_at' => now(), 'updated_at' => now()], // PhD Science
            ['degree_id' => 8, 'fees' => 9500, 'created_at' => now(), 'updated_at' => now()], // PhD Humanities
            ['degree_id' => 9, 'fees' => 12000, 'created_at' => now(), 'updated_at' => now()], // Professional Doctorates
        ]);
    }
}
