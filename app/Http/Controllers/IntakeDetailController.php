<?php

namespace App\Http\Controllers;

use App\Models\IntakeDetail;
use App\Models\Intake;
use Illuminate\Http\Request;

class IntakeDetailController extends Controller
{
    // Display all intake details (general listing)
    public function index()
    {
        $intakeDetails = IntakeDetail::with('intake')->paginate(10);
        return view('admin.intake-details.index', compact('intakeDetails'));
    }

    // Show form to create a new intake detail
    public function create()
    {
        $intakes = Intake::all(); // for dropdown
        return view('admin.intake-details.create', compact('intakes'));
    }

    // Store a new intake detail
    public function store(Request $request)
    {
        $request->validate([
            'intake_id' => 'required|exists:intake,id',
            'event_name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        IntakeDetail::create($request->only(['intake_id', 'event_name', 'start_date', 'end_date']));

        return redirect()->route('admin.intake-details.index')
            ->with('success', 'Intake detail created successfully.');
    }

    // Show a single intake detail
    public function show(IntakeDetail $intake_detail)
    {
        $intake_detail->load('intake');
        return view('admin.intake-details.show', [
            'intakeDetail' => $intake_detail
        ]);
    }


    // Show form to edit an intake detail
    public function edit(IntakeDetail $intake_detail)
    {
        $intakes = Intake::all();
        return view('admin.intake-details.edit', [
            'detail' => $intake_detail,
            'intakes' => $intakes
        ]);
    }


    // Update an existing intake detail
    public function update(Request $request, IntakeDetail $intake_detail)
    {
        $request->validate([
            'intake_id' => 'required|exists:intake,id',
            'event_name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $intake_detail->update($request->only(['intake_id', 'event_name', 'start_date', 'end_date']));

        return redirect()->route('admin.intake-details.index')
            ->with('success', 'Intake detail updated successfully.');
    }

    // Delete an intake detail
    public function destroy(IntakeDetail $intake_detail)
    {
        $intake_detail->delete();

        return redirect()->route('admin.intake-details.index')
            ->with('success', 'Intake detail deleted successfully.');
    }
}
