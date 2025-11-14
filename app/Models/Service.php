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

    public function working_hours(): HasMany
    {
        return $this->hasMany(WorkingHours::class, 'service_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id', 'id');
    }

    public function ownerAndAdminCanView($user_id)
    {
        if (($this->user_id == $user_id && auth()->user()->role == 'service_owner') || auth()->user()->role == 'admin') {
            return true;
        }
        return false;
    }

}
