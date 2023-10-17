<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Characteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'account_count',
        'ip',
        'component_id',
    ];

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function protocols(): HasMany
    {
        return $this->hasMany(Protocol::class);
    }
}
