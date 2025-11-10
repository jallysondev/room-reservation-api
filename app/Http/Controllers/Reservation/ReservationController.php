<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return ReservationResource::collection(Reservation::all());
    }

    public function store(CreateReservationRequest $request)
    {
        return new ReservationResource(Reservation::create($request->validated()));
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function update(CreateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());

        return new ReservationResource($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json();
    }
}
