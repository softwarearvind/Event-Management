<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventApprovalController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('Admin.events.index', compact('events'));
    }

    public function approve($id)
    {
        Event::findOrFail($id)->update([
            'status' => 'Approved'
        ]);

        return back()->with('success', 'Event Approved Successfully');
    }

    public function reject($id)
    {
        Event::findOrFail($id)->update([
            'status' => 'Rejected'
        ]);

        return back()->with('success', 'Event Rejected Successfully');
    }
}
