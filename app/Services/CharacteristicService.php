<?php

namespace App\Services;

use App\Models\Characteristic;

class CharacteristicService
{
    public static function createWithoutSaving($data, int $componentId): Characteristic
    {
        $data['component_id'] = $componentId;

        return Characteristic::create($data);
    }
}
