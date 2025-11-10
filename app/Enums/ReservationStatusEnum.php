<?php

namespace App\Enums;

enum ReservationStatusEnum: int
{
    case CONFIRMED = 1;
    case CANCELLED = 2;
}
