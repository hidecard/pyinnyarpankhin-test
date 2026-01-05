<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create upcoming events
        Event::firstOrCreate(
            ['title' => 'Guest Lecture: AI in Modern Society'],
            [
                'description' => 'Join Dr. Sarah Johnson as she discusses the ethical implications of artificial intelligence in today\'s world.',
                'event_date' => Carbon::create(2025, 6, 15),
                'event_time' => '14:00',
                'location' => 'Main Auditorium',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Annual Cultural Festival'],
            [
                'description' => 'Celebrate diversity with performances, food, and exhibitions from around the world.',
                'event_date' => Carbon::create(2025, 6, 18),
                'event_time' => '09:00',
                'location' => 'University Quad',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Inter-College Basketball Tournament'],
            [
                'description' => 'Cheer for our university team as they compete against rivals in the annual tournament.',
                'event_date' => Carbon::create(2025, 6, 22),
                'event_time' => '16:00',
                'location' => 'Sports Complex',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Web Development Bootcamp'],
            [
                'description' => '3-day intensive workshop covering HTML, CSS, JavaScript and modern frameworks.',
                'event_date' => Carbon::create(2025, 6, 25),
                'event_time' => '10:00',
                'location' => 'Computer Lab B',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Summer Career Fair'],
            [
                'description' => 'Meet with top employers looking to hire students for internships and full-time positions.',
                'event_date' => Carbon::create(2025, 7, 5),
                'event_time' => '09:00',
                'location' => 'Student Center',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Undergraduate Research Symposium'],
            [
                'description' => 'Showcase of outstanding undergraduate research projects across all disciplines.',
                'event_date' => Carbon::create(2025, 7, 10),
                'event_time' => '13:00',
                'location' => 'Science Building',
                'is_active' => true,
            ]
        );

        // Create past events
        Event::firstOrCreate(
            ['title' => 'Spring Science Fair'],
            [
                'description' => 'Annual showcase of student research projects in STEM fields.',
                'event_date' => Carbon::create(2025, 4, 12),
                'event_time' => '10:00',
                'location' => 'Science Building',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Spring Music Festival'],
            [
                'description' => 'Performances by university ensembles and student musicians.',
                'event_date' => Carbon::create(2025, 3, 25),
                'event_time' => '13:00',
                'location' => 'Performing Arts Center',
                'is_active' => true,
            ]
        );

        Event::firstOrCreate(
            ['title' => 'Alumni Weekend'],
            [
                'description' => 'Reunion events for alumni from all graduating classes.',
                'event_date' => Carbon::create(2025, 2, 18),
                'event_time' => '09:00',
                'location' => 'Campus-wide',
                'is_active' => true,
            ]
        );
    }
}
