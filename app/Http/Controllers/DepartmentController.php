<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Degree;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    // Admin: List departments
    public function index()
    {
        $departments = Department::withCount(['majors', 'faculties'])->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }

    // Admin: Show create form
    public function create()
    {
        return view('admin.departments.create');
    }

    // Admin: Store new department
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255|unique:departments,department_name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Department::create($request->only(['department_name']));

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department created successfully.');
    }

    // Admin: Show single department
    public function show(Department $department)
    {
        $department->load(['majors', 'faculties']);
        return view('admin.departments.show', compact('department'));
    }

    // Admin: Show edit form
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    // Admin: Update department
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255|unique:departments,department_name,' . $department->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $department->update($request->only(['department_name']));

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department updated successfully.');
    }

    // Admin: Delete department
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with('success', 'Department deleted successfully.');
    }

    // Public: Show all departments and degrees
    public function publicIndex()
    {
        $departments = Department::withCount(['majors', 'faculties'])->get();

        // Fetch all degrees in one query
        $degrees = Degree::with('duration')->get();

        // Fetch majors
        $majors = Major::with('department')->get();

        return view('department', compact('departments', 'degrees', 'majors'));
    }
}
