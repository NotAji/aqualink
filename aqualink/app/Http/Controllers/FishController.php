<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fish;
use App\Models\User;
use App\Models\Booking;
use App\Models\Reports;
use Illuminate\Support\Facades\Auth;

class FishController extends Controller
{
    //
    public function index()
    {
        $fishes = Fish::where('users_id', Auth::user()->id)->paginate(5);
        $username = auth::user()->name;
        return view("user.myfish", compact("fishes", "username"));
    }

    public function dashboard()
    {
        $fishes = Fish::where('users_id', Auth::user()->id)->paginate(5);
        $username = auth::user()->name;

        $fishBooked = booking::where('users_id', auth::user()->id)->where('status', 'approved')->count();
        $waitingApproval = booking::where('users_id', auth::user()->id)->where('status', 'pending')->count();
        $bookingCount = booking::where('seller_name', auth::user()->name)->where('status', 'pending')->count();

        return view("user.dashboard", compact("fishes", "username", 'fishBooked', 'bookingCount', 'waitingApproval'));
    }

    public function create()
    {
        return view("user.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        fish::create([
            'users_id' => auth::user()->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('user.myfish')->with('success', 'Fish added!');
    }

    public function edit($id)
    {
        $fish = fish::find($id);
        return view('user.edit', compact('fish'));
    }
    public function update(Request $request, $id)
    {
        $fish = fish::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $fish->update($request->only('name', 'price', 'quantity'));

        return redirect()->route('user.myfish')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $fish = fish::findOrFail($id);

        $fish->delete();

        return redirect()->route('user.myfish')->with('success', 'Fish deleted');
    }

    public function reportFish($id)
    {

        $fish = fish::find($id);

        $existing = reports::where('fish_id', $fish->id)->get();



        reports::create([
            'users_id' => 2,
            'fish_id' => $fish->id,
            'sellerName' => 'ajin',
            'fishName' => $fish->name
        ]);

        return response()->json(['message', 'Reported Sucessfully']);
    }
}
