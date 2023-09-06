<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Organization;
use App\Models\User;

class OrganizationController extends Controller
{
    public function uploadImage($image)
    {
        $filename = Str::uuid()->toString() . '-' . time() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/', $filename);

        return $filename;
    }

    public function getOrganization()
    {
        return view('admin.pages.organization', [
            'organizations' => Organization::latest()->get(),
            'users'         => User::where('role', 'user')->latest()->get(),
        ]);
    }

    public function storeOrganization(Request $request)
    {

        $organization               =   new Organization();
        $organization->name         =   $request->name;
        $organization->location     =   $request->location;
        $organization->description  =   $request->description;
        $organization->user_id      =   $request->user_id;

        if($request->hasFile('image')) {
            $organization->photo = $this->uploadImage($request->file('image'));
        } else {
            return 'No Image Selected';
        }

        $organization->save();


        // update user role to organization
        $user = User::find($request->user_id);
        $user->role = 'organization';
        $user->update();

        return redirect()->back()->with('status', 'Organization updated successfully.');
    }

    public function updateOrganization(Request $request, $id)
    {
        // return $request;

        $organization               =   Organization::find($id);
        $organization->name         =   $request->name;
        $organization->location     =   $request->location;
        $organization->description  =   $request->description;

        if($request->hasFile('image')) {
            $organization->photo = $this->uploadImage($request->file('image'));
        }

        $organization->update();

        return redirect()->back()->with('status', 'Organization updated successfully.');
    }

    public function deleteOrganization($id)
    {
        $organization = Organization::find($id);
        $organization->delete();

        return redirect()->back()->with('status', 'Organization deleted successfully.');
    }
}
