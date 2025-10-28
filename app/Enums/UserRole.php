<?php

namespace App\Enums;

enum UserRole: string
{
    case CLIENT = 'client';
    case SERVICE_OWNER = 'service_owner';
    case ADMIN = 'admin';
}
