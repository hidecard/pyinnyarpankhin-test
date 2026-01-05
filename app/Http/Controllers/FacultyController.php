<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::with('department')->latest()->paginate(15);
        return view('admin.faculties.index', compact('faculties'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('admin.faculties.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department_id' => 'required|exists:department,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Faculty::create($request->only(['faculty_name', 'position', 'department_id']));

        return redirect()->route('admin.faculties.index')
            ->with('success', 'Faculty member created successfully.');
    }

    public function show(Faculty $faculty)
    {
        $faculty->load('department');
        return view('admin.faculties.show', compact('faculty'));
    }

    public function edit(Faculty $faculty)
    {
        $departments = Department::all();
        return view('admin.faculties.edit', compact('faculty', 'departments'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department_id' => 'required|exists:department,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $faculty->update($request->only(['faculty_name', 'position', 'department_id']));

        return redirect()->route('admin.faculties.index')
            ->with('success', 'Faculty member updated successfully.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();

        return redirect()->route('admin.faculties.index')
            ->with('success', 'Faculty member deleted successfully.');
    }
}
