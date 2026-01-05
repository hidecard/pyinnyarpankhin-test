<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::with('degrees')->latest()->paginate(15);
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        $degrees = \App\Models\Degree::all();
        return view('admin.majors.create', compact('degrees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'major_name' => 'required|string|max:255',
            'degree_id' => 'required|exists:degree,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $major = Major::create([
            'major_name' => $request->major_name,
            'department_id' => 1, // Default department, will be updated based on degree
        ]);

        // Attach major to degree
        $major->degrees()->attach($request->degree_id);

        return redirect()->route('admin.majors.index')
            ->with('success', 'Major created successfully.');
    }

    public function show(Major $major)
    {
        $major->load('department', 'degrees');
        return view('admin.majors.show', compact('major'));
    }

    public function edit(Major $major)
    {
        $degrees = \App\Models\Degree::all();
        return view('admin.majors.edit', compact('major', 'degrees'));
    }

    public function update(Request $request, Major $major)
    {
        $validator = Validator::make($request->all(), [
            'major_name' => 'required|string|max:255',
            'degree_id' => 'required|exists:degree,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $major->update(['major_name' => $request->major_name]);

        // Sync degrees relationship
        $major->degrees()->sync([$request->degree_id]);

        return redirect()->route('admin.majors.index')
            ->with('success', 'Major updated successfully.');
    }

    public function destroy(Major $major)
    {
        $major->delete();

        return redirect()->route('admin.majors.index')
            ->with('success', 'Major deleted successfully.');
    }
}
