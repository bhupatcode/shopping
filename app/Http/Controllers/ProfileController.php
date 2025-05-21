<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6|confirmed',
        'profile_image' => 'nullable|image|max:2048',
        'address' => 'nullable|string|max:500',
    ]);

    $user->name = $request->name;
    $user->address = $request->address;

    if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profiles', 'public');
        $user->profile_image = $path;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

   return redirect()->route('checkout.index')->with('success', 'Address updated! You can now place your order.');


}

}

