<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationManagementController extends Controller
{
    /**
     * Display a listing of the locations.
     */
    public function index()
    {
        $locations = Location::withCount('events')->paginate(10);
        return view('locations.manage.index_new', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function create()
    {
        return view('locations.manage.create');
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('locations.manage.create')
                ->withErrors($validator)
                ->withInput();
        }

        Location::create($validator->validated());

        return redirect()->route('locations.manage.index')
            ->with('success', 'Локацію успішно створено.');
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit(Location $location)
    {
        return view('locations.manage.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     */
    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('locations.manage.edit', $location->id)
                ->withErrors($validator)
                ->withInput();
        }

        $location->update($validator->validated());

        return redirect()->route('locations.manage.edit', $location->id)
            ->with('success', 'Локацію успішно оновлено.');
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy(Location $location)
    {
        // Перевіряємо, чи є події, пов'язані з цією локацією
        $eventsCount = $location->events()->count();

        if ($eventsCount > 0) {
            return redirect()->route('locations.manage.index')
                ->with('error', "Неможливо видалити локацію, оскільки з нею пов'язано {$eventsCount} подій.");
        }

        $location->delete();

        return redirect()->route('locations.manage.index')
            ->with('success', 'Локацію успішно видалено.');
    }
}
