<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after_or_equal:today',
            'event_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
                $data['image'] = $imagePath;
            }

            Event::create($data);

            return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            // Delete uploaded image if creation failed
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to create event: ' . $e->getMessage());
        }
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($event->image && Storage::disk('public')->exists($event->image)) {
                    Storage::disk('public')->delete($event->image);
                }
                $imagePath = $request->file('image')->store('events', 'public');
                $data['image'] = $imagePath;
            }

            $event->update($data);

            return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            // Delete uploaded image if update failed
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to update event: ' . $e->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        try {
            // Delete image if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $event->delete();

            return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete event: ' . $e->getMessage());
        }
    }

    public function toggle(Event $event)
    {
        $event->update(['is_active' => !$event->is_active]);

        return redirect()->route('admin.events.index')->with('success', 'Event status updated successfully.');
    }

    public function publicIndex()
    {
        $upcomingEvents = Event::where('is_active', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->get() ?? collect();

        $pastEvents = Event::where('is_active', true)
            ->where('event_date', '<', now())
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get() ?? collect();

        // Get featured events (events marked as featured or the most recent/upcoming ones)
        $featuredEvents = Event::where('is_active', true)
            ->orderBy('event_date', 'asc')
            ->limit(2)
            ->get() ?? collect();

        // Get events for calendar view (current month and next month)
        $currentMonth = now()->startOfMonth();
        $nextMonth = now()->addMonth()->startOfMonth();

        $calendarEvents = Event::where('is_active', true)
            ->whereBetween('event_date', [$currentMonth, $nextMonth->endOfMonth()])
            ->orderBy('event_date', 'asc')
            ->get() ?? collect();

        // Group calendar events by date, ensuring we return a collection
        $calendarEvents = $calendarEvents->groupBy(function ($event) {
            return $event->event_date->format('Y-m-d');
        });

        return view('event', compact('upcomingEvents', 'pastEvents', 'featuredEvents', 'calendarEvents'));
    }
}
