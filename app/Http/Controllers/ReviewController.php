<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Review;
use App\Models\Notification;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $event = Event::find($id);
        $org_id = $event->organize_by;

        // Store a new review for the event
        // $request->validate([
        //     'rating' => 'required|integer|min:1|max:5',
        //     'comment' => 'required|string|max:255',
        // ]);

        $review = new Review([
            'user_id' => auth()->user()->id,
            'event_id'  =>  $id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        $event->reviews()->save($review);

        // send notification
        $notification = new Notification;
        $notification->type     = 'Event Review';
        $notification->title    = 'Event Review';
        $notification->message  = auth()->user()->name . ' reviewed ' . $event->name . ' event';
        $notification->event_id = $id;  // event ko id ho
        $notification->user_id  = auth()->user()->id;   // request garney
        $notification->org_id   = $org_id;   // event ko org id ho
        $notification->noti_to_user   = $org_id;    // event creator lai notice janxa

        $notification->save();

        return redirect()->back()->with('status', 'Review added successfully.');
    }
}
