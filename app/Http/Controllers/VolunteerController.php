<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use App\Models\Event;
use App\Models\Notification;

class VolunteerController extends Controller
{
    public function store(Request $request, $id)
    {

        // get the id of ORG from event id
        $event = Event::find($id);
        $org_id = $event->organize_by;


        $volunteer  =  new Volunteer;
        $volunteer->event_id = $id;
        $volunteer->user_id = auth()->user()->id;
        $volunteer->type = $request->type;
        $volunteer->description = $request->description;
        $volunteer->org_id = $org_id;

        $volunteer->save();

        // send notification to event
        $notification = new Notification;
        $notification->type     = 'Volunteer';
        $notification->title    = 'Volunteer Request';
        $notification->message  = 'Volunteer Request from ' . auth()->user()->name . ' for ' . $event->name . ' event';
        $notification->event_id = $id;  // event ko id ho
        $notification->user_id  = auth()->user()->id;   // request garney
        $notification->org_id   = $org_id;   // event ko org id ho
        $notification->noti_to_user   = $org_id;    // event creator lai notice janxa

        $notification->save();


        return redirect()->back()->with('status', 'Submit successfully');

    }


    public function approve($id)
    {
        $volunteer = Volunteer::find($id);
        $volunteer->status = 'Approve';
        $volunteer->update();

        // send notification to user
        $notification = new Notification;
        $notification->type     = 'Volunteer';
        $notification->title    = 'Volunteer Request';
        $notification->message  = $volunteer->user->name . ' Your volunteer request has been approved';
        $notification->event_id = $volunteer->event_id;
        $notification->user_id  = $volunteer->org_id;
        $notification->org_id   = $volunteer->org_id;
        $notification->noti_to_user = $volunteer->user_id;

        $notification->save();

        return redirect()->back()->with('status', 'Volunteer Request has been approved');
    }
}
