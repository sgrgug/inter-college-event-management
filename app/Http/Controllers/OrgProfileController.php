<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\File;

class OrgProfileController extends Controller
{
    public function index()
    {
        $org = Organization::where('user_id', auth()->user()->id)->first();

        return view('organization.org_profile_update', compact('org'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required | string | min:5 | max:30',
            'description' => 'required | string | min:10 | max:100',
            'location' => 'required | string | min:4 | max:30',
            'photo' => 'required | mimes:jpg,jpeg,png',
        ]);

        // auth user org id
        $org = Organization::where('user_id', auth()->user()->id)->first();
        $org_id = $org->id;

        // store
        $organization = Organization::find($org_id);
        $organization->name = $request->name;
        $organization->description = $request->description;
        $organization->location = $request->location;


        if($org->photo){


            File::delete('uploads/'.$organization->photo);

            $photo = $request->file('photo');
            $filename = Str::slug($request->name) . '-' . time() . '.' . $photo->getClientOriginalExtension();

            $photo->move(public_path('uploads/'), $filename);


            $organization->photo = $filename;


        } else {
            $photo = $request->file('photo');
            $filename = Str::slug($request->name) . '-' . time() . '.' . $photo->getClientOriginalExtension();

            $photo->move(public_path('uploads/'), $filename);


            $organization->photo = $filename;
        }




            // update
            $organization->update();


        return redirect()->route('organization.org_profile_update')->with('status', 'Successfully Saved!');

    }
}
