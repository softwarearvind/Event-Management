<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\EventRegistration;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Product;


class FrountController extends Controller
{
     public function index()
     {
     $products = Product::with('images')->where('status', 'approved')->latest()->get();
     $events = Event::where('status', 'Approved')->whereDate('event_date', '>=', Carbon::today())->latest()->get();
      return view('welcome', compact('events','products'));
     }


     public function show($id)
{
    $event = Event::findOrFail($id);
    return view('show', compact('event'));
}

public function ticket($id)
{
    $event = Event::findOrFail($id);

    return view('ticket', compact('event'));
}

public function register($id)
{
    $event = Event::findOrFail($id);

    // check already registered
    $exists = EventRegistration::where('event_id', $id)
                ->where('user_id', auth()->id())
                ->first();

    if ($exists) {
        return back()->with('error', 'Already Registered for this event');
    }

    $registration = EventRegistration::create([
        'event_id' => $id,
        'user_id' => auth()->id(),
        'ticket_code' => strtoupper(Str::random(10))
    ]);

    return redirect()->route('event.ticket', $id)->with('success', 'Registered Successfully');
}

public function details($slug)
{
$product = Product::with('images')->whereRaw('LOWER(REPLACE(name, " ", "-")) = ?', [strtolower($slug)])->firstOrFail();

  return view('deatals',compact('product'));

}
}
