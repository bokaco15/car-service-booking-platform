<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'service_id',
        'client_id',
        'service_offering_id',
        'start_at',
        'end_at',
        'status'
    ];
}
