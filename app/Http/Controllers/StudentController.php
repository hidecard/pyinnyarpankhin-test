<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Major;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dob' => 'nullable|date',
            'father_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email_address' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Generate student_id
        $data['student_id'] = 'STU' . rand(10000, 99999);

        // Generate username (First 3 letters + pp + 2-digit number = 7 characters)
        $nameParts = explode(' ', $request->student_name);
        $firstPart = strtolower($nameParts[0]);

        if (count($nameParts) >= 2) {
            // Use first 3 characters from first name + first char from middle name
            $username = substr($firstPart, 0, 2) . strtolower(substr($nameParts[1], 0, 1)) . 'pp' . rand(10, 99);
        } else {
            // Use first 3 characters from first name
            $username = substr($firstPart, 0, 3) . 'pp' . rand(10, 99);
        }
        $data['username'] = $username;

        // Generate password (pp + 5-digit number)
        $data['password'] = 'pp' . rand(10000, 99999);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }

        Student::create($data);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dob' => 'nullable|date',
            'father_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email_address' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:7',
            'status' => 'required|in:active,inactive',
        ]);

        $student = Student::findOrFail($id);
        $data = $request->all();

        // Only update password if provided
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }

        $student->update($data);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}

