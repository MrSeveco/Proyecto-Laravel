<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::with('venue')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->event_name = $request->input('event_name');
        $event->event_date = $request->input('event_date');
        $event->event_max_capacity = $request->input('event_max_capacity');
        $event->event_is_virtual = $request->input('event_is_virtual');
        $event->save();

        return response()->json(['message' => 'Event created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response()->json(['event' => $event, 'venue' => $event->venue]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->event_name = $request->input('event_name');
        $event->event_date = $request->input('event_date');
        $event->event_max_capacity = $request->input('event_max_capacity');
        $event->event_is_virtual = $request->input('event_is_virtual');
        $event->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully.']);
    }
}