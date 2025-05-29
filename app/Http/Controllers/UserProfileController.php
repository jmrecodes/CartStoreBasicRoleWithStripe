<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route('profile.show')->with('status', 'Profile updated successfully!');
    }

    /**
     * Show the form for changing the user's password.
     *
     * @return \Illuminate\View\View
     */
    public function showChangePasswordForm(): View
    {
        return view('profile.change-password');
    }

    /**
     * Change the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (!\Illuminate\Support\Facades\Hash::check($value, $user->password)) {
                    $fail('The :attribute is incorrect.');
                }
            }],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.show')->with('status', 'Password changed successfully!');
    }
} 