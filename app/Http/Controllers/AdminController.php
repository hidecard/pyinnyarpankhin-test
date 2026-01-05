<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Degree;
use App\Models\Major;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Intake;
use App\Models\Admission;
use App\Models\Event;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch real data from database
        $stats = [
            'students' => Student::count(),
            'faculty' => Faculty::count(),
            'subjects' => Subject::count(),
            'departments' => Department::count(),
        ];

        // Recent subjects
        $recentSubjects = Subject::latest()->take(5)->get();

        // Recent activities - using the actual model field names
        $recentAdmissions = Admission::latest()->take(3)->get();
        $recentEvents = Event::where('is_active', true)->latest()->take(2)->get();
        $recentStudents = Student::latest()->take(3)->get();

        return view('admin.index', compact(
            'stats',
            'recentSubjects',
            'recentAdmissions',
            'recentEvents',
            'recentStudents'
        ));
    }

    public function academic()
    {
        $degreesCount = Degree::count();
        $majorsCount = Major::count();
        $departmentsCount = Department::count();
        $facultiesCount = Faculty::count();

        return view('admin.academic', compact(
            'degreesCount',
            'majorsCount',
            'departmentsCount',
            'facultiesCount'
        ));
    }

    public function students()
    {
        return view('admin.students');
    }

    public function calendar()
    {
        $events = Event::where('is_active', true)->orderBy('event_date', 'asc')->get();
        return view('admin.calendar', compact('events'));
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}

