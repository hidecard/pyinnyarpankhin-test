<?php

namespace App\Http\Controllers;

use App\Models\Duration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DurationController extends Controller
{
    public function index()
    {
        $durations = Duration::latest()->paginate(15);
        return view('admin.durations.index', compact('durations'));
    }

    public function create()
    {
        return view('admin.durations.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'length' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Duration::create($request->only(['length']));

        return redirect()->route('admin.durations.index')
            ->with('success', 'Duration created successfully.');
    }

    public function show(Duration $duration)
    {
        return view('admin.durations.show', compact('duration'));
    }

    public function edit(Duration $duration)
    {
        return view('admin.durations.edit', compact('duration'));
    }

    public function update(Request $request, Duration $duration)
    {
        $validator = Validator::make($request->all(), [
            'length' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $duration->update($request->only(['length']));

        return redirect()->route('admin.durations.index')
            ->with('success', 'Duration updated successfully.');
    }

    public function destroy(Duration $duration)
    {
        $duration->delete();

        return redirect()->route('admin.durations.index')
            ->with('success', 'Duration deleted successfully.');
    }
}
