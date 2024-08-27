<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    //update profile API
    public function updateProfile(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'user_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'file' => 'required',
            'file.*' => 'required|mimes:jpeg,jpg|max:2048',
        ]);

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->file('file')) {
            $file_name = time() . rand(1, 99) . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('uploads'), $file_name);
            $files[]['name'] = $file_name;
            $file_path = $file_name;
            $user = User::find(Auth::user()->id);
            if ($user->profile != null) {
                unlink(public_path('uploads') . '/' . $user->profile);
            }
            $user->profile = $file_path;
            $user->save();
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile_image' => url('uploads/' . $user->profile_image),
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    // updatePassword API
    public function updatePassword(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the current user
        $user = User::find($request->user_id);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }
}
