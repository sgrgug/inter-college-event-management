<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Event;
use App\Models\Notification;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('can:isOrg');
    }

    public function index()
    {
        // get authorg id
        $authOrgId = Organization::where('user_id', auth()->user()->id)->first()->id;
        // For Notification Count
        $notificationCount = Notification::where('noti_to_user', auth()->user()->id)->where('read', false)->count();
        // For All Notification
        $notifications = Notification::where('noti_to_user', auth()->user()->id)->limit(6)->get();

        return view('dashboard', [
            'org'               =>  Organization::where('user_id', auth()->user()->id)->firstOrFail(),
            'myEvents'          =>  Event::where('organize_by', auth()->user()->id)->limit(2)->get(),
            'myEventCount'      =>  Event::where('organize_by', auth()->user()->id)->count(),
            'notificationCount' =>  $notificationCount,
            'notifications'     =>  $notifications,
            'volunteers'        =>  Volunteer::where('org_id', $authOrgId)->where('status', 'Null')->get(),
        ]);
    }
}
