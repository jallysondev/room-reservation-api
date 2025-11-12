<?php

namespace App\Services\Reservation;

use App\Models\Reservation;
use App\Repositories\Reservation\ReservationRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationService
{
    public function __construct(
        protected readonly ReservationRepository $reservationRepository
    ) {}

    public function create(array $validatedData): Reservation
    {
        return $this->reservationRepository->create($validatedData);
    }

    public function update(Reservation $reservation, array $validatedData): Reservation
    {
        return $this->reservationRepository->update($reservation, $validatedData);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->reservationRepository->getAll();
    }

    public function delete(Reservation $reservation): void
    {
        $this->reservationRepository->delete($reservation);
    }
}
