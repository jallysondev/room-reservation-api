<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService
    )
    {
    }

    public function login(LoginRequest $request): Response
    {
        try {
            return response()->json($this->authService->login($request->validated()));
        } catch (InvalidCredentialsException) {
            response()->json(['message' => 'Invalid credentials.'], Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            Log::error(' FAILED TO LOGIN ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to login. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function logout(Request $request): Response
    {
        try {
            $this->authService->logout($request);

            return response()->noContent();
        } catch (Exception $exception) {
            Log::error(' FAILED TO LOGOUT ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to logout. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
