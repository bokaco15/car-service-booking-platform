<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    public function serviceOffering():BelongsTo
    {
        return $this->belongsTo(ServiceOffering::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

}
