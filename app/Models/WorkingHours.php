<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkingHours extends Model
{
    use HasFactory;

    const TABLE = 'working_hours';

    protected $table = self::TABLE;
    protected $fillable = [
      'service_id',
      'day_of_week',
      'opens_at',
      'closes_at',
    ];


    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
