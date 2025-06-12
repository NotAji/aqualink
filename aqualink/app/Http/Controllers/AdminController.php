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
            ->paginate(5, ['*'], 'dashboardPage');

        $totalFish = fish::count();
        $totalBookings = booking::count();
        $totalUsers = user::where('role', '!=', 'admin')->count();

        return view("admin.dashboard", compact('users', 'totalFish', 'totalBookings', 'totalUsers'));
    }

    public function browse()
    {
        $booking = fish::where('users_id', '!=', auth::user()->id)->paginate(5);
        $sellerID = $booking->pluck('users_id')->unique();
        $sellers = User::whereIn('id', $sellerID)->get()->keyBy('id');
        return view('admin.browse', compact('booking', 'sellers'));
    }

    public function userManagement()
    {
        $users = user::where('role', '!=', 'admin')->paginate(5);

        return view('admin.user-management', compact('users'));
    }

    public function reports()
    {
        $reports = reports::paginate(5);

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

    public function removeFish($id)
    {
        $removeFish = fish::find($id);
        $removeFish->delete();
        return redirect()->route('admin.browse');
    }
}
