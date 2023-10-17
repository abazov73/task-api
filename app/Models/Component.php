<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $section_index
 * @property ?string $comment
 * @property Collection<Characteristic> $characteristics
 */
class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section_index',
        'comment',
    ];

    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }
}
