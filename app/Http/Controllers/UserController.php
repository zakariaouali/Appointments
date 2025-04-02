<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $pendingUsers = User::where('is_activated', false)->get();
        return view('profile', compact('pendingUsers'));
    }

    public function activateUser(User $user, Request $request)
    {
        $user->is_activated = $request->input('status') == 'accepted';
        $user->save();

        return redirect()->route('profile')->with('status', 'User status updated successfully.');
    }
}