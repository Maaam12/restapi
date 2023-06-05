<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['username'] = $user->username;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $success
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['username'] = $user->username;

            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or password',
                'data' => null
            ], 401);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        if ($token) {
            $token->delete();
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to logout',
                'data' => null
            ], 500);
        }
    }


    public function protectedResource(Request $request)
    {
        // Check if the user is authenticated
        if (auth()->user()) {
            // User is authenticated, return the protected data
            return response()->json([
                'success' => true,
                'message' => 'Access to protected resource granted',
                'data' => [
                    // Your protected data here
                ]
            ]);
        } else {
            // User is not authenticated, return an unauthorized response
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }
    }
}
