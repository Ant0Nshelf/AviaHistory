<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EventManagementController extends Controller
{
    // Middleware auth застосовується через маршрути в web.php

    /**
     * Display a listing of the events.
     */
    public function index(): View
    {
        $events = Event::with('location')->orderBy('event_date', 'desc')->paginate(10);

        return view('events.manage.index_new', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create(): View
    {
        $locations = Location::all();

        return view('events.manage.create', compact('locations'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location_id' => 'nullable|exists:locations,id',
            'new_location' => 'nullable|string|max:255',
            'location_type' => 'nullable|string|max:255',
            'image_url' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:2048', // Макс. 2MB
        ]);

        // Видаляємо поля, які не потрібно зберігати в базі даних
        unset($validated['image_file']);
        unset($validated['new_location']);
        unset($validated['location_type']);

        // Якщо вказано нову локацію, створюємо її
        if ($request->filled('new_location')) {
            $location = Location::create([
                'name' => $request->new_location,
                'type' => $request->location_type ?? 'Інше',
                'description' => '',
            ]);

            $validated['location_id'] = $location->id;
        }

        // Якщо завантажено файл, він має пріоритет над URL
        if ($request->hasFile('image_file')) {
            // Створюємо директорію, якщо вона не існує
            if (!Storage::exists('public/images/events')) {
                Storage::makeDirectory('public/images/events');
            }

            // Отримуємо файл
            $file = $request->file('image_file');

            // Генеруємо унікальне ім'я файлу
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Зберігаємо файл в публічній директорії
            $file->move(public_path('images/events'), $fileName);

            // Зберігаємо URL в базі даних
            $validated['image_url'] = '/images/events/' . $fileName;
        }

        Event::create($validated);

        return redirect()->route('events.manage.index')
            ->with('success', 'Подію успішно створено.');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event): View
    {
        // Додаємо відладочну інформацію
        \Log::info('Edit method called with event ID: ' . $event->id);

        $locations = Location::all();

        return view('events.manage.edit', compact('event', 'locations'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Додаємо відладочну інформацію
        \Log::info('Update method called');
        \Log::info('Request data:', $request->all());

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'event_date' => 'required|date',
                'location_id' => 'nullable|exists:locations,id',
                'new_location' => 'nullable|string|max:255',
                'location_type' => 'nullable|string|max:255',
                'image_url' => 'nullable|string|max:255',
                'image_file' => 'nullable|image|max:2048', // Макс. 2MB
                'current_image' => 'nullable|string',
            ]);

            \Log::info('Validation passed');

            // Видаляємо поля, які не потрібно зберігати в базі даних
            unset($validated['image_file']);
            unset($validated['current_image']);
            unset($validated['new_location']);
            unset($validated['location_type']);

            // Якщо вказано нову локацію, створюємо її
            if ($request->filled('new_location')) {
                \Log::info('Creating new location: ' . $request->new_location);

                $location = Location::create([
                    'name' => $request->new_location,
                    'type' => $request->location_type ?? 'Інше',
                    'description' => '',
                ]);

                $validated['location_id'] = $location->id;
                \Log::info('New location created with ID: ' . $location->id);
            }

            // Якщо завантажено файл, він має пріоритет над URL
            if ($request->hasFile('image_file')) {
                \Log::info('Processing uploaded file');

                // Створюємо директорію, якщо вона не існує
                if (!Storage::exists('public/images/events')) {
                    Storage::makeDirectory('public/images/events');
                }

                // Отримуємо файл
                $file = $request->file('image_file');

                // Генеруємо унікальне ім'я файлу
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Зберігаємо файл в публічній директорії
                $file->move(public_path('images/events'), $fileName);

                // Зберігаємо URL в базі даних
                $validated['image_url'] = '/images/events/' . $fileName;
                \Log::info('File stored at: ' . $validated['image_url']);
            } elseif (empty($validated['image_url']) && $request->has('current_image')) {
                // Якщо URL не вказано, але є поточне зображення, зберігаємо його
                $validated['image_url'] = $request->current_image;
                \Log::info('Using current image: ' . $validated['image_url']);
            }

            \Log::info('Updating event with data:', $validated);
            $event->update($validated);
            \Log::info('Event updated successfully');

            return redirect()->route('events.manage.edit', $event->id)
                ->with('success', 'Подію успішно оновлено.');
        } catch (\Exception $e) {
            \Log::error('Error updating event: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Помилка при оновленні події: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.manage.index')
            ->with('success', 'Подію успішно видалено.');
    }
}
