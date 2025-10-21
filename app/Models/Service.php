<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
      'user_id',
      'name',
      'city',
      'description',
      'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers()
    {
        return $this->hasMany(ServiceOffering::class, 'service_id', 'id');
    }

    public function working_hours()
    {
        return $this->hasMany(WorkingHours::class, 'service_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id', 'id');
    }

    public function ownerAndAdminCanView($user_id)
    {
        if ($this->user_id == $user_id || auth()->user()->role == 'admin') {
            return true;
        }
        return false;
    }

}
