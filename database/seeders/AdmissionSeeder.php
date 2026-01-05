<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admission;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admission::create([
            'admissions_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '123-456-7890',
            'department_id' => 1,
            'minimum_gpa' => 3.5,
            'transcripts' => 'Uploaded',
            'recommendation' => 2,
            'edu_degree' => 'BSc',
            'sop' => 1,
        ]);

        Admission::create([
            'admissions_name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '098-765-4321',
            'department_id' => 2,
            'minimum_gpa' => 3.8,
            'transcripts' => 'Uploaded',
            'recommendation' => 3,
            'edu_degree' => 'MEng',
            'sop' => 2,
        ]);

        Admission::create([
            'admissions_name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'phone' => '555-123-4567',
            'department_id' => 3,
            'minimum_gpa' => 3.2,
            'transcripts' => 'Uploaded',
            'recommendation' => 1,
            'edu_degree' => 'BBA',
            'sop' => 1,
        ]);
    }
}
