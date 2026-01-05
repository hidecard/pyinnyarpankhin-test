<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Department;
use App\Models\Duration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DegreeController extends Controller
{
    public function index()
    {
        $degrees = Degree::with('duration', 'department')->latest()->paginate(15);
        return view('admin.degrees.index', compact('degrees'));
    }

    public function create()
    {
        $durations = Duration::all();
        $departments = Department::all();
        return view('admin.degrees.create', compact('durations', 'departments'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'degree_name' => 'required|string|max:255',
            'level' => 'required|in:undergraduate,masters,doctoral,postgraduate',
            'duration_id' => 'required|exists:duration,id',
            'department_id' => 'nullable|exists:department,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Degree::create($request->only(['degree_name', 'level', 'duration_id', 'department_id']));

        return redirect()->route('admin.degrees.index')
            ->with('success', 'Degree created successfully.');
    }

    public function show(Degree $degree)
    {
        $degree->load('duration', 'department', 'majors');
        return view('admin.degrees.show', compact('degree'));
    }

    public function edit(Degree $degree)
    {
        $durations = Duration::all();
        $departments = Department::all();
        return view('admin.degrees.edit', compact('degree', 'durations', 'departments'));
    }

    public function update(Request $request, Degree $degree)
    {
        $validator = Validator::make($request->all(), [
            'degree_name' => 'required|string|max:255',
            'level' => 'required|in:undergraduate,masters,doctoral,postgraduate',
            'duration_id' => 'required|exists:duration,id',
            'department_id' => 'nullable|exists:department,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $degree->update($request->only(['degree_name', 'level', 'duration_id', 'department_id']));

        return redirect()->route('admin.degrees.index')
            ->with('success', 'Degree updated successfully.');
    }

    public function destroy(Degree $degree)
    {
        $degree->delete();

        return redirect()->route('admin.degrees.index')
            ->with('success', 'Degree deleted successfully.');
    }
}
