<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function createStudent(): View
    {
        return view('auth.register-student');
    }

    public function createLecturer(): View
    {
        return view('auth.register-lecturer');
    }

    public function storeStudent(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'reg_no' => ['required', 'string', 'max:50', 'unique:users,reg_no'],
            'department' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'reg_no' => $validated['reg_no'],
            'department' => $validated['department'],
            'email' => $validated['email'],
            'role' => 'student',
            'password' => $validated['password'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Student account created successfully.');
    }

    public function storeLecturer(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'department' => $validated['department'] ?? 'ICT Department',
            'email' => $validated['email'],
            'role' => 'lecturer',
            'password' => $validated['password'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Lecturer account created successfully.');
    }
}
