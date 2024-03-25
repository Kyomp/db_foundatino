<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_type_id',
        'branch_id',
        'color',
        'availability',
    ];

    public function branch(): BelongsToMany{
        return $this->belongsToMany(Branch::class);
    }
    public function carType(): BelongsToMany{
        return $this->belongsToMany(CarType::class);
    }
    public function contracts(): HasOne{
        return $this->hasOne(Contract::class);
    }
}
