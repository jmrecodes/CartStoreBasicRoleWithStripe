<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all users except the currently logged-in admin
        $users = User::where('id', '!=', Auth::id())->orderBy('name', 'asc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->id === Auth::id()) {
            // Prevent admin from editing their own account through this specific user management interface
            // They can use their own profile page for name/email/password changes.
            // Role changes for self are handled by promote/demote or prevented.
            return redirect()->route('admin.users.index')->with('error', 'You cannot edit your own account details here. Use your profile settings.');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot update your own account details here.');
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()], // Nullable: only update if provided
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', "User {$user->name} updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        // Optional: Add any other checks, e.g., cannot delete last admin, etc.

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User {$userName} deleted successfully.");
    }

    /**
     * Promote or demote a user.
     */
    public function promote(Request $request, User $user)
    {
        // Gate::authorize('promote', $user); // We'll add this policy check later

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot change your own role.');
        }

        $newRole = $user->role === 'admin' ? 'user' : 'admin';
        $user->role = $newRole;
        $user->save();

        $action = $newRole === 'admin' ? 'promoted' : 'demoted';
        return redirect()->route('admin.users.index')->with('success', "User {$user->name} has been {$action}.");
    }
}
