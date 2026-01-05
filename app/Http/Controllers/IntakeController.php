<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntakeController extends Controller
{
    public function index()
    {
        $intakes = Intake::with('intakeDetails')->paginate(15);
        return view('admin.intakes.index', compact('intakes'));
    }

    public function create()
    {
        return view('admin.intakes.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:intake,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Intake::create($request->only(['name']));

        return redirect()->route('admin.intakes.index')
            ->with('success', 'Intake created successfully.');
    }

    public function show(Intake $intake)
    {
        $intake->load('intakeDetails');
        return view('admin.intakes.show', compact('intake'));
    }

    public function edit(Intake $intake)
    {
        return view('admin.intakes.edit', compact('intake'));
    }

    public function update(Request $request, Intake $intake)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:intake,name,' . $intake->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $intake->update($request->only(['name']));

        return redirect()->route('admin.intakes.index')
            ->with('success', 'Intake updated successfully.');
    }

    public function destroy(Intake $intake)
    {
        // Delete related intake details first to avoid foreign key constraint
        $intake->intakeDetails()->delete();

        $intake->delete();

        return redirect()->route('admin.intakes.index')
            ->with('success', 'Intake deleted successfully.');
    }
}
