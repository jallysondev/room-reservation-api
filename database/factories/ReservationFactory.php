<?php

namespace Database\Factories;

use App\Enums\ReservationStatusEnum;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'user_id' => User::factory(),
            'description' => $this->faker->sentence(),
            'start_at' => Carbon::now()->addDays($this->faker->numberBetween(1, 30)),
            'end_at' => Carbon::now()->addDays($this->faker->numberBetween(31, 60)),
            'status' => ReservationStatusEnum::CONFIRMED->value,
        ];
    }
}
