<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController
{
    public function store(Request $request)
    {
        $request->validate([
            'email'         => ['required', 'email'],
            'password'      => ['required'],
            'device_token'  => ['nullable']
        ]);

        $user = User::where('email', $request->post('email'))->first();

        if (!$user || !Hash::check($request->post('password'), $user->password)) {
            return response()->json([
                'error' => 'Invalid credentials.'
            ], 401);
        }

        // Create token (give token a name, e.g. "auth-token")
        $token = $user->createToken('auth-token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user'  => $user
        ]);
    }

    /**
     * 
     *  Destroy token
     * 
     **/
    public function delete($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user)
            return response()->json(['error'       => 'Not Auth | token requried']);

        if (null === $token) {
            $user->currentAccessToken()->delete();
            return response()->json(['message'          => 'Current auth user token has been deleted successfully']);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (
            $user->id == $personalAccessToken->tokenable_id &&
            get_class($user) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
            return response()->json(['message'          => 'Token has been deleted successfully']);
        }
    }

    public function destroy(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user)
            return response()->json(['error'            => 'Not Auth | Auth required']);

        $user->tokens->each(fn($token) => $token->delete());

        return response()->json(['message'          => 'Destroy all user tokens']);
    }
}
