<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Models\User;;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $credentials): ?array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new InvalidCredentialsException();
        }

        $user->tokens()->delete();

        $token = $user->createToken($credentials['device_name'])->plainTextToken;

        return [
            'token' => $token
        ];
    }

    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();

        return [
            'message'  => 'Logout completed successfully.'
        ];
    }
}
