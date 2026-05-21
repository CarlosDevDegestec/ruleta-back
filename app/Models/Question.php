<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'type', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
