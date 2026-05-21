<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rarity', 'weight', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'weight' => 'integer',
    ];

    const RARITY_LABELS = [
        'comun'       => 'Común',
        'poco_comun'  => 'Poco Común',
        'raro'        => 'Raro',
        'epico'       => 'Épico',
        'legendario'  => 'Legendario',
    ];

    const RARITY_COLORS = [
        'comun'       => '#424242',
        'poco_comun'  => '#1B5E20',
        'raro'        => '#0D47A1',
        'epico'       => '#4A148C',
        'legendario'  => '#F57F17',
    ];

    const RARITY_WEIGHTS = [
        'comun'       => 15,
        'poco_comun'  => 8,
        'raro'        => 5,
        'epico'       => 3,
        'legendario'  => 1,
    ];

    public function getRarityLabelAttribute(): string
    {
        return self::RARITY_LABELS[$this->rarity] ?? $this->rarity;
    }

    public function getRarityColorAttribute(): string
    {
        return self::RARITY_COLORS[$this->rarity] ?? '#424242';
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
