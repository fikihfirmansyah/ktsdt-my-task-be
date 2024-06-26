<?php

namespace App\Http\Controllers\API;

use App\Contracts\Request;
use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\LecturerResource;
use App\Http\Resources\StudentResource;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param \App\Contracts\Request $request The HTTP request object.
     * @throws \Illuminate\Validation\ValidationException If the validation fails.
     * @return \App\Contracts\Response The JSON response containing the success message and the registered user.
     */
    public function register(RegisterRequest $request)
    {
        try
        {
            $data = $request->validated();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            if ($request->role == 1) {
                $student = Student::create($data);
                return Response::okCreated(new StudentResource($student));

            }

            if ($request->role == 2) {
                $lecture = Lecturer::create($data);
                return Response::okCreated(new LecturerResource($lecture));

            }

        } catch (\Exception $e) {
            return Response::abortInternalError($e);
        }

    }

    /**
     * Authenticates a user and returns a JSON response containing their authentication token.
     *
     * @param Request $request The HTTP request object containing the user's email and password.
     * @throws \Exception If an error occurs during authentication or token creation.
     * @return \App\Contracts\Response The JSON response containing the authentication token or an error message.
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();

            if (Auth::attempt($credentials)) {
                $user = $request->user();
                $token = $user->createToken('authToken')->plainTextToken;

                return (Response::json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]));

            }

            return Response::abortUnauthorized();

        } catch (\Exception $e) {
            return Response::abortInternalError($e);
        }
    }

    /**
     * A description of the entire PHP function.
     *
     * @param Request $request description
     * @throws \Exception description of exception
     * @return Response
     */
    public function me(HttpRequest $request)
    {
        try {
            $user = $request->user();
            $role = $user->role;

            if ($role == 1) {
                $user = Student::where('email', $user->email)->first();

                var_dump($user);
                exit;
                return Response::json(new StudentResource($user));
            } elseif ($role == 2) {

                $user = Lecturer::where('email', $user->email)->first();
                return Response::json(new LecturerResource($user));
            }

        } catch (\Exception $e) {
            return Response::abortInternalError($e);

        }
    }

    /**
     * Logs out the user by deleting the current access token.
     *
     * @param Request $request The HTTP request.
     * @return Response The HTTP response.
     */
    public function logout(HttpRequest $request)
    {
        $request->user()->currentAccessToken()->delete();

        return Response::noContent();
    }

}
