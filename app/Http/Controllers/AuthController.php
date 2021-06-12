<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Request\AuthValidation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate(
            $request,
            AuthValidation::rules()
        );

        try {
            $user = new User;
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(
                [
                    'user' => $user,
                    'message' => 'CREATED'
                ],
                201
            );

        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        //validate incoming request
        $this->validate(
            $request,
            [
                'email' => 'required|string',
                'password' => 'required|string',
            ]
        );

        $credentials = $request->only(
            [
                'email',
                'password'
            ]
        );

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
