<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // University Information
            ['key' => 'university_name', 'value' => 'Pyinnyar Pankhin University', 'type' => 'string', 'group' => 'general'],
            ['key' => 'university_address', 'value' => 'Myanaung, Ayeyarwaddy Myanmar', 'type' => 'string', 'group' => 'general'],
            ['key' => 'university_phone', 'value' => '(09) 456789101', 'type' => 'string', 'group' => 'general'],
            ['key' => 'university_email', 'value' => 'pininyarpankhin@gmail.com', 'type' => 'string', 'group' => 'general'],
            ['key' => 'university_website', 'value' => 'https://pyinnyarpankhin.edu.mm', 'type' => 'string', 'group' => 'general'],

            // Academic Settings
            ['key' => 'academic_year_start', 'value' => '6', 'type' => 'integer', 'group' => 'academic'], // Month (June)
            ['key' => 'academic_year_end', 'value' => '5', 'type' => 'integer', 'group' => 'academic'], // Month (May)
            ['key' => 'default_program_duration', 'value' => '4', 'type' => 'integer', 'group' => 'academic'], // Years
            ['key' => 'max_credits_per_semester', 'value' => '18', 'type' => 'integer', 'group' => 'academic'],
            ['key' => 'min_credits_per_semester', 'value' => '12', 'type' => 'integer', 'group' => 'academic'],

            // Student Settings
            ['key' => 'max_students_per_class', 'value' => '30', 'type' => 'integer', 'group' => 'student'],
            ['key' => 'admission_deadline_days', 'value' => '30', 'type' => 'integer', 'group' => 'student'],
            ['key' => 'tuition_fee_per_credit', 'value' => '50', 'type' => 'integer', 'group' => 'student'], // USD
            ['key' => 'allow_online_admissions', 'value' => 'true', 'type' => 'boolean', 'group' => 'student'],
            ['key' => 'require_entrance_exam', 'value' => 'false', 'type' => 'boolean', 'group' => 'student'],

            // Faculty Settings
            ['key' => 'max_students_per_faculty', 'value' => '25', 'type' => 'integer', 'group' => 'faculty'],
            ['key' => 'faculty_evaluation_period', 'value' => '6', 'type' => 'integer', 'group' => 'faculty'], // Months
            ['key' => 'min_faculty_qualifications', 'value' => 'masters', 'type' => 'string', 'group' => 'faculty'],

            // Finance Settings
            ['key' => 'currency', 'value' => 'MMK', 'type' => 'string', 'group' => 'finance'],
            ['key' => 'payment_deadline_days', 'value' => '15', 'type' => 'integer', 'group' => 'finance'],
            ['key' => 'late_fee_percentage', 'value' => '5', 'type' => 'integer', 'group' => 'finance'],
            ['key' => 'scholarship_percentage', 'value' => '25', 'type' => 'integer', 'group' => 'finance'],

            // System Settings
            ['key' => 'maintenance_mode', 'value' => 'false', 'type' => 'boolean', 'group' => 'system'],
            ['key' => 'backup_frequency', 'value' => 'daily', 'type' => 'string', 'group' => 'system'],
            ['key' => 'session_timeout', 'value' => '60', 'type' => 'integer', 'group' => 'system'], // Minutes
            ['key' => 'max_file_upload_size', 'value' => '10', 'type' => 'integer', 'group' => 'system'], // MB

            // Security Settings
            ['key' => 'password_min_length', 'value' => '8', 'type' => 'integer', 'group' => 'security'],
            ['key' => 'password_require_special_chars', 'value' => 'true', 'type' => 'boolean', 'group' => 'security'],
            ['key' => 'two_factor_required', 'value' => 'false', 'type' => 'boolean', 'group' => 'security'],
            ['key' => 'max_login_attempts', 'value' => '5', 'type' => 'integer', 'group' => 'security'],
            ['key' => 'account_lockout_duration', 'value' => '30', 'type' => 'integer', 'group' => 'security'], // Minutes
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
