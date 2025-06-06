<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fish;
use App\Models\User;
use App\Models\Reports;
use App\Models\Booking;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $users = user::withCount(['fish', 'booking'])
            ->where('role', '!=', 'admin')
            ->get();

        return view("admin.dashboard", compact('users'));
    }

    public function browse()
    {
        $booking = fish::where('users_id', '!=', auth::user()->id)->get();
        $sellerID = $booking->pluck('users_id')->unique();
        $sellers = User::whereIn('id', $sellerID)->get()->keyBy('id');
        return view('admin.browse', compact('booking', 'sellers'));
    }

    public function userManagement()
    {
        $users = user::where('role', '!=', 'admin')->get();

        return view('admin.user-management', compact('users'));
    }

    public function reports()
    {
        $reports = reports::all();

        return view('admin.reports', compact('reports'));
    }

    public function removeFishOnReports($id)
    {
        $fish = fish::find($id);

        $fish->delete();

        return redirect()->route('admin.reports');
    }

    public function removeUser($id)
    {

        $user = user::find($id);

        $user->delete();

        return redirect()->route('admin.user-management');
    }
}
