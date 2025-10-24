<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceOffering extends Model
{
    use HasFactory;

    const TABLE = 'service_offerings';
    protected $table = self::TABLE;
    protected $fillable = [
        'service_id',
        'name',
        'duration_minutes',
        'price',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
