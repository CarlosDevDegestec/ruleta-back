<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = ['prize_id', 'name', 'phone', 'email', 'notifications'];

    protected $casts = [
        'notifications' => 'boolean',
    ];

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }
}
