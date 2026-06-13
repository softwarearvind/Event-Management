<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventCotroller extends Controller
{
    public function index()
    {
    	 $events = Event::where('user_id', auth()->id())->latest()->get();    	
    	 return view('manager.event.index', compact('events'));
    }

    public function create()
    {
    	return view('manager.event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'event_date'  => 'required',
            'location'    => 'required',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $banner = null;

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner')->store('events', 'public');
        }

        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'banner'      => $banner,
            'status'      => 'Pending',
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('event.index')->with('success', 'Event Created Successfully');
    }


    public function edit($id)
    {
    	$event = Event::findOrFail($id);
    	return view ('manager.event.edit',compact('event'));
    }

    public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'event_date' => $request->event_date,
        'location' => $request->location,
    ];

    if ($request->hasFile('banner')) {
        $data['banner'] = $request->file('banner')
                                  ->store('events', 'public');
    }

    $event->update($data);

    return redirect()->route('event.index')
                     ->with('success', 'Event Updated Successfully');
}

public function destroy($id)
{
    $event = Event::findOrFail($id);

    // Delete Image
    if ($event->banner && Storage::disk('public')->exists($event->banner)) {
        Storage::disk('public')->delete($event->banner);
    }

    // Delete Record
    $event->delete();

    return redirect()
        ->route('event.index')
        ->with('success', 'Event Deleted Successfully');
}
}
