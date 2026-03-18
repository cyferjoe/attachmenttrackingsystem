<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function registerStudent(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'reg_no' => ['required', 'string', 'max:50', 'unique:users,reg_no'],
            'department' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
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

        $token = $this->issueToken($user);

        return response()->json([
            'message' => 'Student registered successfully.',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function registerLecturer(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'department' => $validated['department'] ?? 'ICT Department',
            'email' => $validated['email'],
            'role' => 'lecturer',
            'password' => $validated['password'],
        ]);

        $token = $this->issueToken($user);

        return response()->json([
            'message' => 'Lecturer registered successfully.',
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 422);
        }

        $token = $this->issueToken($user);

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->update([
            'api_token' => null,
        ]);

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    private function issueToken(User $user): string
    {
        $plainToken = Str::random(60);

        $user->update([
            'api_token' => hash('sha256', $plainToken),
        ]);

        return $plainToken;
    }
}
