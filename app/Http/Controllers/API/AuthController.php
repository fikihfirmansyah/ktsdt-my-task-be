<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @throws \Illuminate\Validation\ValidationException If the validation fails.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the success message and the registered user.
     */
    public function register(Request $request)
    {
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->role == 1) {
                Student::create([
                    'email' => $user->email,
                    'name' => $user->name,
                ]);
            }

            if ($request->role == 2) {
                Lecturer::create([
                    'email' => $user->email,
                    'name' => $user->name,
                ]);
            }

            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    /**
     * Authenticates a user and returns a JSON response containing their authentication token.
     *
     * @param Request $request The HTTP request object containing the user's email and password.
     * @throws \Exception If an error occurs during authentication or token creation.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the authentication token or an error message.
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (Auth::attempt($credentials)) {
                $user = $request->user();
                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json(['token' => $token]);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $request->user();
            $role = $user->role;
            if ($role == 1) {
                $user = Student::where('email', $user->email)->first();
            } elseif ($role == 2) {
                $user = Lecturer::where('email', $user->email)->first();
            }

            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);

        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

}
