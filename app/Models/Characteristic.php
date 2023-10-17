<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $address
 * @property int $account_count
 * @property string $ip
 * @property Component $component
 * @property Collection<Protocol> $protocols
 */
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
