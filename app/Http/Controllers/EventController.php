<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Organization;

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

        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
