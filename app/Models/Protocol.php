<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $type
 * @property int $port
 * @property Characteristic $characteristic
 */
class Protocol extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'port',
        'characteristic_id',
    ];

    public function characteristic(): BelongsTo
    {
        return $this->belongsTo(Characteristic::class);
    }
}
