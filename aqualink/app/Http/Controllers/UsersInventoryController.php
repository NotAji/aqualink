<?php

namespace App\Http\Controllers;

use App\Models\usersInventory;
use Illuminate\Http\Request;

class UsersInventoryController extends Controller
{
    //
    public function index()
    {
        $users = UsersInventory::all();
        return view("user.dashboard", compact("users"));
    }

    public function create()
    {
        return view("user.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|float',
            'quantity' => 'required|integer'
        ]);

        usersInventory::create($request->only('name', 'price', 'quantity'));

        return redirect()->route('user.dashboard')->with('success', 'Fish added!');
    }

    public function update($id) {}

    public function destroy($id) {}
}
