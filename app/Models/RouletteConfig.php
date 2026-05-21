<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouletteConfig extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function current(): self
    {
        return self::first() ?? self::create([
            'title'    => '¡Gira y Gana!',
            'subtitle' => 'Participa y llévate increíbles premios',
            'is_active' => true,
        ]);
    }
}
