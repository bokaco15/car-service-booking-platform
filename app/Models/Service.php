<?php

namespace App\Models;

use App\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
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

}
