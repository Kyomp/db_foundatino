<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foreigner extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'issued_at',
        'issue_date',
        'expiry_date'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
