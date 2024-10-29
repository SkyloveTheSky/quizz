<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hashids\Hashids;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user profile.
     *
     * @param  string  $hashed_user_id
     * @return \Illuminate\Http\Response
     */
    public function show($hashed_user_id)
    {
        $hashids = new Hashids();
        $userId = $hashids->decode($hashed_user_id)[0] ?? null;
        $user = User::findOrFail($userId);

        if (auth()->user()->id !== $user->id) {
            return redirect()->route('profile.edit', ['hashed_user_id' => $hashed_user_id])
                             ->with('error', 'User not authenticated or unauthorized.');
        }

        return view('auth.profiles.show', compact('user', 'hashed_user_id'));
    }

    /**
     * Show the profile edit form.
     *
     * @param  string  $hashed_user_id
     * @return \Illuminate\Http\Response
     */
    public function edit($hashed_user_id)
    {
        $hashids = new Hashids();
        $userId = $hashids->decode($hashed_user_id)[0] ?? null;
        $user = User::findOrFail($userId);

        if (auth()->user()->id !== $user->id) {
            return redirect()->route('profile.edit', ['hashed_user_id' => $hashed_user_id])
                             ->with('error', 'User not authenticated or unauthorized.');
        }

        return view('auth.profiles.edit', compact('user', 'hashed_user_id'));
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $hashed_user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hashed_user_id)
    {
        $hashids = new Hashids();
        $userId = $hashids->decode($hashed_user_id)[0] ?? null;
        $user = User::findOrFail($userId);

        if (auth()->user()->id !== $user->id) {
            return redirect()->route('profile.edit', ['hashed_user_id' => $hashed_user_id])
                             ->with('error', 'User not authenticated or unauthorized.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->input('name');

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('profile.show', ['hashed_user_id' => $hashed_user_id])
                         ->with('success', 'Profile updated successfully.');
    }
}
