<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Interest;
use App\Models\Category;
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


        // $user = User::find(auth()->user()->id);

        // $org_name = $user->organization->name;

        return view('home', compact(['check']));
    }

    public function add_interest()
    {

        $user = User::find(auth()->user()->id);
        $categories = [1, 3];


        if($user->interests()->whereIn('category_id', $categories)->exists()){
            return redirect()->route('home');
        } else {
            $user->categories()->attach($categories);
            return 'done';
        }
    }
}
