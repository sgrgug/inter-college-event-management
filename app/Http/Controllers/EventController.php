<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\Category;
use App\Models\User;

class EventController extends Controller
{

    public function __construct(){
        $this->middleware('can:isOrg')->except('index');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('events.index');
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

        return view('events.create', compact('event_cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string | min:5 | max:30',
            'description' => 'required | string | min:10',
            'photo' => 'required | mimes:jpg,jpeg,png',
            'location' => 'required | string | min:4 | max:15',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->cat_id = $request->cat_value;

        $user = User::find(auth()->user()->id)->organization;
        $event->organize_by = $user->name;


        
        $photo = $request->file('photo');
        $filename = Str::slug($request->name) . '-' . time() . '.' . $photo->getClientOriginalExtension();

        $photo->move(public_path('uploads/event/'), $filename);


        $event->photo = $filename;

        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
