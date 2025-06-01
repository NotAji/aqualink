<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fish;
use App\Models\User;
use App\Models\Booking;

class BookingController extends Controller
{
    //
    public function index()
    {
        $bookings = Booking::all();

        return view("user.mybooking", compact('bookings'));
    }

    public function bookFish($id)
    {
        $booking = fish::find($id);
        $seller = User::find($booking->users_id);

        return view('user.bookfish', compact('booking', 'seller'));
    }

    public function storeBooking(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $fish = fish::findOrFail($id);
        $fishDetails = fish::all();

        dd($fishDetails->price);

        if ($request->quantity > $fish->quantity) {
            return back()->with('error', 'Not enough fish available');
        }

        $user = fish::find($id);
        $userID = user::find($user->users_id);

        booking::create([
            'name' => $fishDetails->name,
            'price' => $fishDetails->price,
            'users_id' => auth::user()->id,
            'fish_id' => $id,
            'quantity' => $request->quantity,
        ]);

        $fish->quantity -= $request->quantity;
        $fish->save();

        return redirect()->route('user.mybooking')->with('success', 'Fish booked');
    }

    public function browse()
    {
        $booking = fish::where('users_id', '!=', auth::user()->id)->get();
        $sellerID = $booking->pluck('users_id')->unique();
        $sellers = User::whereIn('id', $sellerID)->get()->keyBy('id');
        return view('user.browse', compact('booking', 'sellers'));
    }
}
