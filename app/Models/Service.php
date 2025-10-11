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

}
