<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Notifications\EventNotifications;
class EventController extends Controller
{
   // EventController.php

   private function getFutureEvents()
   {
       return Event::where('date', '>=', now())->orderBy('date')->get();
   }

   public function index()
   {
       $events = $this->getFutureEvents();
       return view('dashboard', compact('events'));
   }

   public function show($id)
   {
       $event = Event::findOrFail($id);
       $events = $this->getFutureEvents();
       return view('dashboard', compact('event', 'events'));
   }

   public function events(Request $request)
   {
       $validatedData = $request->validate([
           'name' => 'required|string|max:255',
           'date' => 'required|date',
           'time' => 'required|date_format:H:i',
           'location' => 'required|string|max:255',
           'description' => 'required|string',
       ]);

       $eventcreate = new Event();
       $eventcreate->name = $validatedData['name'];
       $eventcreate->date = $validatedData['date'];
       $eventcreate->time = $validatedData['time'];
       $eventcreate->location = $validatedData['location'];
       $eventcreate->description = $validatedData['description'];

       $eventname = $validatedData['name'];
       $eventdate = $validatedData['date'];
       $eventtime = $validatedData['time'];
       $students = User::where('is_admin', 0)->get();

       // Notify each user individually
       foreach ($students as $student) {
           $student->notify(new EventNotifications($eventname, $eventdate, $eventtime));
       }
       $eventcreate->save();
       return redirect()->back()->with('success', 'Event Added Successfully.');
   }

   public function showadminevent()
   {
       $events = Event::all();
       return view('adminevent', ['events' => $events]);
   }
   public function update(Request $request, $id)
{
    
    $events = Event::find($id);
    $events->name = $request->input('edit_name');
    $events->date = $request->input('edit_date');
    $events->time = $request->input('edit_time');
    $events->location = $request->input('edit_location');
    $events->description = $request->input('edit_description');
    // Strip tags after validation


    // Update all fields
    $events->update();
    return redirect()->back()->with('success', 'Event Updated Successfully.');
}


   public function destroy($id)
   {
       $event = Event::findOrFail($id);
       $event->delete();

       return redirect()->back()->with('success', 'Event Deleted Successfully.');
   }

   public function edit(Request $request, $id)
   {
        $events= Event::find($id);
       return view('events.edit', compact('events'));
   }
   
}
