<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    const TABLE = 'bookings';

    protected $table = self::TABLE;
    protected $fillable = [
        'service_id',
        'client_id',
        'service_offering_id',
        'start_at',
        'end_at',
        'status'
    ];

    protected function casts():array
    {
        return [
            'status' => BookingStatus::class,
        ];
    }

}
