<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Event;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('can:isOrg');
    }

    public function index()
    {
        $myEventCount = Event::where('organize_by', auth()->user()->id)->count();

        return view('dashboard', [
            'org' =>   Organization::where('user_id', auth()->user()->id)->firstOrFail(),
            'myEventCount'  =>  $myEventCount,
        ]);
    }
}
