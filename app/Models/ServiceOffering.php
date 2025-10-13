<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOffering extends Model
{
    protected $table = 'service_offerings';
    protected $fillable = [
        'service_id',
        'name',
        'duration_minutes',
        'price',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function bookings()
    {
        return $this->hasMany(ServiceOffering::class, 'service_offering_id', 'id');
    }

}
