<?php

namespace App\Services;

use App\Models\Component;

class ComponentService
{
    public static function createWithoutSaving($data): Component
    {
        return Component::create($data);
    }

    public static function destroy(Component $component)
    {
        $component->delete();
    }
}
