<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
    * Register User
    * @method Post
    * @method Request $request
    * @return JsonResponse
    */
    public function register(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Add User To Database
        resolve(UserRepository::class)->create($request);

        return response()->json([
            'message' => "user created succesfully"
        ], Response::HTTP_CREATED);
    }

    /**
    * Login User
    * @method Post
    * @method Request $request
    * @return JsonResponse
    */
    public function login(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check User credentials.
        if (Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(Auth::user() ,Response::HTTP_OK);
        }
        
        throw ValidationException::withMessages([
            'email' => 'Incorrect credentials.',
        ]);
    }

    public function user()
    {
        return response()->json(Auth::user() ,Response::HTTP_OK);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'Logged out'
        ] ,Response::HTTP_OK);
    }
}
