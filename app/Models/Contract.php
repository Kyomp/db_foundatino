<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'price',
    ];

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
    public function car(): BelongsToMany{
        return $this->belongsToMany(Car::class);
    }
}
