<?php

namespace App\Services;

use App\Models\Protocol;

class ProtocolService
{
    public function create($data): Protocol
    {
        return Protocol::create($data);
    }
}