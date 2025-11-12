<?php

namespace App\Repositories\Reservation;

use App\Models\Reservation;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationRepository
{
    public function __construct(
        protected readonly Reservation $reservation
    ) {}

    public function create(array $data): Reservation
    {
        return $this->reservation->create($data);
    }

    public function update(Reservation $reservation, array $validatedData): Reservation
    {
        $reservation->update($validatedData);

        return $reservation->refresh();
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->reservation->paginate();
    }

    public function delete(Reservation $reservation): bool
    {
        return $reservation->delete();
    }
}
