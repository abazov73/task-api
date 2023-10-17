<?php

namespace App\Services;

use App\Models\Characteristic;

class CharacteristicService
{
    public function create($data): Characteristic
    {
        return Characteristic::create($data);
    }
}