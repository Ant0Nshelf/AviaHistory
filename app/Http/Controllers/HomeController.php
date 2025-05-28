<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        // Отримуємо всі події, відсортовані за датою (найновіші спочатку)
        $events = Event::with('location')
            ->orderBy('event_date', 'desc')
            ->paginate(10);

        // Отримуємо всі локації для можливої фільтрації
        $locations = Location::all();

        return view('home', compact('events', 'locations'));
    }

    /**
     * Filter events by location.
     */
    public function filterByLocation(Request $request): View
    {
        $locationId = $request->location_id;

        $query = Event::with('location');

        if ($locationId) {
            $query->where('location_id', $locationId);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(10);
        $locations = Location::all();

        return view('home', compact('events', 'locations'));
    }

    /**
     * Show the event details.
     */
    public function show(Event $event): View
    {
        // Завантажуємо зв'язану локацію
        $event->load('location');

        // Отримуємо попередню та наступну події для навігації
        $previousEvent = Event::where('event_date', '<', $event->event_date)
            ->orderBy('event_date', 'desc')
            ->first();

        $nextEvent = Event::where('event_date', '>', $event->event_date)
            ->orderBy('event_date', 'asc')
            ->first();

        // Отримуємо інші події з тієї ж локації
        $relatedEvents = Event::where('location_id', $event->location_id)
            ->where('id', '!=', $event->id)
            ->limit(3)
            ->get();

        return view('events.show', compact('event', 'previousEvent', 'nextEvent', 'relatedEvents'));
    }
}
