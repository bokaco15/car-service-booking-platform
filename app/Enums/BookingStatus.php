<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case DONE = 'done';
}

