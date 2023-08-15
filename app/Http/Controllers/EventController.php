<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\Category;
use App\Models\User;
use App\Models\EventUser;


class EventController extends Controller
{

    public function __construct(){
        $this->middleware('can:isOrg')->except('index', 'show', 'joinEvent', 'getDataByCat', 'myJoinEvent');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events     =   Event::with('category', 'organization')->get();
        $cats       =   Category::all();

        return view('events.index', [
            'events' => $events,
            'cats' => $cats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // To check whether any of attribute is null or not
        $data = Organization::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->whereNull('name')->orWhereNull('description');
            })->first();

        // this check whether org profile is complete or if not then go to complete
        if ($data) {
            return redirect()->route('organization.org_profile_update');
        }

        //event category show 
        $event_cat = Category::all();

        $org = Organization::where('user_id', auth()->user()->id)->first();

        return view('events.create', compact('event_cat', 'org'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string | min:5 | max:50',
            'slug' => 'required | string | unique:events| min:5 | max:50',
            'description' => 'required | string | min:10',
            'photo' => 'required | mimes:jpg,jpeg,png',
            'location' => 'required | string | min:4 | max:30',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->slug = Str::slug($request->slug);
        $event->description = $request->description;
        $event->location = $request->location;
        $event->cat_id = $request->cat_value;

        //find the org id
        $org = Organization::where('user_id', auth()->user()->id)->with('user')->first();
        $event->organize_by = $org->user->id;


        $event->start = $request->datetime;


        
        $photo = $request->file('photo');
        $filename = Str::slug($request->name) . '-' . time() . '.' . $photo->getClientOriginalExtension();

        $photo->move(public_path('uploads/event/'), $filename);


        $event->photo = $filename;

        $event->save();

        // descrease value of noofcreation
        if($org->prosub == false)
        {
            if($org->noofcreation > 0 && $org->noofcreation <= 5)
            {
                $updateorg = Organization::where('user_id', auth()->user()->id)->first();

                $updateorg->noofcreation = $org->noofcreation - 1;
                $updateorg->update();
            } else {
                return "You have reached your limit of creating event.";
            }
        }

        return redirect()->route('events.create')->with('status', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $org = Organization::where('user_id', auth()->user()->id)->with('user')->first();

        // yasko adhar ma org id match garney
        $event = Event::where('id', $id)->with('organization')->first();

        $eventI_OrgId = $event->organization->id;

        $authOrgId = $org ? $org->user->id : 0;

        return view('events.show', compact('event','eventI_OrgId', 'authOrgId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $org = Organization::where('user_id', auth()->user()->id)->with('user')->first();

        // yasko adhar ma org id match garney
        $event = Event::where('id', $id)->with('organization')->first();

        $eventI_OrgId = $event->organization->id;

        $authOrgId = $org ? $org->user->id : 0;

        // only access owner of the event
        if(Gate::allows('isOrg') && $authOrgId != $eventI_OrgId){
            return redirect()->route('events.index');
        }

        
        $event = Event::where('id', $id)->with('category')->first();

        $event_cat = Category::all();

        return view('events.edit', compact('event','event_cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        $validate = $request->validate([
            'name' => 'required | string | min:5 | max:50',
            'slug' => 'required | string | unique:events | min:5 | max:50',
            'description' => 'required | string | min:10',
            'photo' => 'nullable | mimes:jpg,jpeg,png',
            'location' => 'required | string | min:4 | max:30',
        ]);


        if($validate)
        {
            $event->name = $request->name;

            $event->update();
        }

        return "done";
    }

    public function getDataByCat(string $slug)
    {
        $cat_id = Category::where('slug', $slug)->first();
        if($slug == Null){
            $events     =   Event::with('category')->get();
        }else{
            $events     =   Event::where('cat_id', $cat_id->id)->with('category')->get();
        }
        $cats       =   Category::all();
        return view('events.index', [
            'events' => $events,
            'cats' => $cats,
        ]);
    }
    public function joinEvent($id)
    {
        $user = auth()->user();

        if($user->events->contains($id))
        {
            $user->events()->detach($id);

            return redirect()->route('events.show', $id)->with('status', 'You have left the event');
        } else {
            $user->events()->attach($id);

            return redirect()->route('events.show', $id)->with('status', 'You have joined the event');
        }

    }

    // detail about the created event only access by org
    public function myCreateEvent()
    {
        $myCreatedEvents = Event::where('organize_by', auth()->user()->id)->get();

        return view('events.mycreateevents', [
            'myCreatedEvents' => $myCreatedEvents,
        ]);
    }


    // My Event
    public function myJoinEvent()
    {
        $authUserEvent = User::where('id', auth()->user()->id)
                        ->with('events')
                        ->first();

        $myJoinedEvents = $authUserEvent->events;

        return view('events.joinevent', [
            'myJoinedEvents' => $myJoinedEvents,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
