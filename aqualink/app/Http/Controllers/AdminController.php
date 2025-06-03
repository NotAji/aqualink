<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fish;
use App\Models\User;
use App\Models\Booking;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $users = user::where('role', '!=', 'admin')->get();

        foreach ($users as $user) {
            $fishes = fish::where('users_id', $user->id)->count();
        }

        return view("admin.dashboard", compact('users', 'fishes'));
    }
}
