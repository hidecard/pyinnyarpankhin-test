<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Always insert postgraduate degrees (idempotent insert)
        $postgraduates = [
            ['degree_name' => 'Postgraduate Diploma in Business Management', 'duration_id' => 1, 'level' => 'postgraduate'],
            ['degree_name' => 'Postgraduate Certificate in Data Science', 'duration_id' => 1, 'level' => 'postgraduate'],
            ['degree_name' => 'Master of Philosophy (MPhil)', 'duration_id' => 2, 'level' => 'postgraduate'],
            ['degree_name' => 'Postgraduate Diploma in Education (PGDE)', 'duration_id' => 1, 'level' => 'postgraduate'],
        ];

        foreach ($postgraduates as $pg) {
            // Check if this degree already exists
            $exists = DB::table('degree')
                ->where('degree_name', $pg['degree_name'])
                ->where('level', 'postgraduate')
                ->exists();

            if (!$exists) {
                DB::table('degree')->insert(array_merge($pg, [
                    'created_at' => now(),
                    'updated_at' => now()
                ]));
            }
        }

        $this->command->info('Postgraduate degrees seeded successfully!');
    }
}

