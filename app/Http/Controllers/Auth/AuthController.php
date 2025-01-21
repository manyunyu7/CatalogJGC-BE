<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Killa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getUserInfo(Request $request)
    {
        // Return the authenticated user's information
        return response()->json([
            'meta' => [
                'success' => true,
                'status' => 200,
                'message' => 'User information fetched successfully',
            ],
            'result' => $request->user(),  // This will return the authenticated user
        ]);
    }

    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return Killa::responseErrorWithMetaAndResult(422, 422, 'Validation failed', $validator->errors());
        }

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            return Killa::responseErrorWithMetaAndResult(401, 401, 'Invalid credentials', []);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        $result_data = [
            'user' => $user,
            'token' => $token,
        ];

        // Return success response with user data and token
        return Killa::responseSuccessWithMetaAndResult(200, 200, 'Login successful', $result_data);
    }
}
