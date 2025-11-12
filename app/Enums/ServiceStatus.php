<?php

namespace App\Enums;

enum ServiceStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
}
