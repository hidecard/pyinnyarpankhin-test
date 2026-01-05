<?php

namespace App\Http\Controllers;

use App\Models\SubSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subSubjects = SubSubject::with('subject')->get();
        return view('admin.sub-subjects.index', compact('subSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('admin.sub-subjects.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SubSubject::create($request->all());

        return redirect()->route('admin.sub-subjects.index')->with('success', 'Sub Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subSubject = SubSubject::with('subject')->findOrFail($id);
        return view('admin.sub-subjects.show', compact('subSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subSubject = SubSubject::findOrFail($id);
        $subjects = Subject::all();
        return view('admin.sub-subjects.edit', compact('subSubject', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'sub_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subSubject = SubSubject::findOrFail($id);
        $subSubject->update($request->all());

        return redirect()->route('admin.sub-subjects.index')->with('success', 'Sub Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subSubject = SubSubject::findOrFail($id);
        $subSubject->delete();

        return redirect()->route('admin.sub-subjects.index')->with('success', 'Sub Subject deleted successfully.');
    }
}
