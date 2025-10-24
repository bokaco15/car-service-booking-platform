<?php

namespace App\Models;

use App\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    const TABLE = 'services';

    protected $table = self::TABLE;
    protected $fillable = [
      'user_id',
      'name',
      'city',
      'description',
      'status'
    ];

    protected function casts(): array {
        return [
            'status' => ServiceStatus::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(ServiceOffering::class, 'service_id', 'id');
    }

}
