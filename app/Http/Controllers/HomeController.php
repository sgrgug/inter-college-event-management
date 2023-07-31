<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Interest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organization;

class HomeController extends Controller
{
    public function index()
    {

        // To check whether any of attribute is null or not
        $data = Organization::where('user_id', auth()->user()->id)
            ->where(function ($query) {
                $query->whereNull('name')
                ->orWhereNull('description')
                ->orWhereNull('photo')
                ->orWhereNull('location');
            })->first();

        if ($data) {
            $check = 1;
        } else {
            $check = 0;
        }


        //to check whether user setup their interest or not
        $hasData = Interest::where('user_id', auth()->user()->id)->exists();

        if($hasData){
            $checkingInterest = 1;
        } else {
            $checkingInterest = 0;
        }


        //retrieve all data from event category
        $categories = Category::all();

        // $user = User::latest()->with('interests')->get();
        $interest = Interest::where('user_id', auth()->user()->id)->latest()->get();
        $idsArray = [];

        foreach ($interest as $key => $value) {
            $idsArray[] = $value->category_id;
        }

        $cat = Category::whereIn('id', $idsArray)->get();

       $events =   Event::whereIn('cat_id', $idsArray)->latest()->get();

        return view('home', compact(['check', 'checkingInterest','categories', 'events']));
    }

    public function add_interest(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $categories = $request->input('options');
        $categories = array_map('intval', $categories);
        // $categories = [1, 3];


        if($user->interests()->whereIn('category_id', $categories)->exists()){
            return redirect()->route('home');
        } else {
            $user->categories()->attach($categories);
            return 'done';
        }
    }
}
