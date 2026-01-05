<?php

namespace App\Http\Controllers;

use App\Models\Tuition;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tuitions = Tuition::with('degree')->paginate(15);
        return view('admin.tuitions.index', compact('tuitions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $degrees = Degree::all();
        return view('admin.tuitions.create', compact('degrees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'degree_id' => 'required|exists:degree,id',
            'fees' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Tuition::create($request->all());

        return redirect()->route('admin.tuitions.index')
            ->with('success', 'Tuition created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tuition $tuition)
    {
        $tuition->load('degree');
        return view('admin.tuitions.show', compact('tuition'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tuition $tuition)
    {
        $degrees = Degree::all();
        return view('admin.tuitions.edit', compact('tuition', 'degrees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tuition $tuition)
    {
        $validator = Validator::make($request->all(), [
            'degree_id' => 'required|exists:degree,id',
            'fees' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tuition->update($request->all());

        return redirect()->route('admin.tuitions.index')
            ->with('success', 'Tuition updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tuition $tuition)
    {
        $tuition->delete();

        return redirect()->route('admin.tuitions.index')
            ->with('success', 'Tuition deleted successfully.');
    }
}
