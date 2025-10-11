<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
    protected $table = 'working_hours';
    protected $fillable = [
      'service_id',
      'day_of_week',
      'opens_at',
      'closes_at',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
