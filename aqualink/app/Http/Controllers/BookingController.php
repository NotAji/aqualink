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
        $bookings = booking::with('fish.user')
            ->where('users_id', auth::user()->id)
            ->paginate(5, ['*'], 'bookingPage');

        $buyers = booking::with(['user', 'fish'])->where('seller_name', auth::user()->name)->where('status', 'pending')->paginate(5, ['*'], 'buyerPage');

        return view("user.mybooking", compact('bookings', 'buyers'));
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

        if ($request->quantity > $fish->quantity) {
            return back()->with('error', 'Not enough fish available');
        }

        $user = user::find($fish->users_id);

        booking::create([
            'users_id' => auth::user()->id,
            'fish_id' => $id,
            'fish_name' => $fish->name,
            'seller_name' => $user?->name,
            'quantity' => $request->quantity,
        ]);

        $fish->quantity -= $request->quantity;
        $fish->save();


        return redirect()->route('user.mybooking');
    }

    public function browse()
    {
        $booking = fish::where('users_id', '!=', auth::user()->id)->paginate(5);
        $sellerID = $booking->pluck('users_id')->unique();
        $sellers = User::whereIn('id', $sellerID)->get()->keyBy('id');
        return view('user.browse', compact('booking', 'sellers'));
    }

    public function destroyBooking($id)
    {
        $destroyBook = booking::find($id);
        $fish = $destroyBook->fish;

        $fish->quantity += $destroyBook->quantity;
        $fish->save();

        $destroyBook->delete();

        return redirect()->route('user.mybooking')->with('success', 'Booking Canceled');
    }

    public function declineBooking($id)
    {
        $declined = booking::findOrFail($id);
        $declined->status = 'declined';
        $declined->save();

        return redirect()->route('user.mybooking');
    }

    public function approveBooking($id)
    {
        $approved = booking::findOrFail($id);
        $approved->status = 'approved';
        $approved->save();

        return redirect()->route('user.mybooking');
    }
}
