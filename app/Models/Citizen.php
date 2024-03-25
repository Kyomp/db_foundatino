<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable=[
        'citizen_no',
        'user_id',
        'address',
        'issue_date',
        'expiry_date'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
