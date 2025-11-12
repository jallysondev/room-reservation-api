<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Services\Reservation\ReservationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function __construct(
        protected readonly ReservationService $reservationService
    ) {}

    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            return ReservationResource::collection($this->reservationService->getAll());
        } catch (Exception $exception) {
            Log::error(' FAILED TO LIST RESERVATIONS ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to list reservations. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function store(CreateReservationRequest $request): ReservationResource|JsonResponse
    {
        try {
            return ReservationResource::make($this->reservationService->create($request->validated()));
        } catch (Exception $exception) {
            Log::error(' FAILED TO CREATE RESERVATION ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to create reservation. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function update(Reservation $reservation, UpdateReservationRequest $request): ReservationResource|JsonResponse
    {
        try {
            return ReservationResource::make($this->reservationService->update($reservation, $request->validated()));
        } catch (Exception $exception) {
            Log::error(' FAILED TO UPDATE RESERVATION ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to update reservation. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function show(Reservation $reservation): ReservationResource|JsonResponse
    {
        try {
            return ReservationResource::make($reservation);
        } catch (Exception $exception) {
            Log::error(' FAILED TO DETAIL RESERVATION ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to detail reservation. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function destroy(Reservation $reservation): Response
    {
        try {
            $this->reservationService->delete($reservation);

            return response()->noContent();
        } catch (Exception $exception) {
            Log::error(' FAILED TO DESTROY RESERVATION ', [
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        }

        return response()->json(['message' => 'Failed to destroy reservation. Please try again later.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
