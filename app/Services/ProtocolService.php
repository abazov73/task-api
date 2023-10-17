<?php

namespace App\Services;

use App\Models\Protocol;

class ProtocolService
{
    public static function createWithoutSaving($data, int $characteristic_id): Protocol
    {
        $data['characteristic_id'] = $characteristic_id;

        return new Protocol($data);
    }
}
