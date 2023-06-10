<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrgProfileController extends Controller
{
    public function index()
    {
        $org = Organization::where('user_id', auth()->user()->id)->first();

        return view('organization.org_profile_update', compact('org'));
    }
}
