<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        return view('admin.dashboard');
    }

    public function getUser()
    {
        return view('admin.pages.user', [
            'users' => User::all(),
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('status', 'User deleted successfully');
    }
}
