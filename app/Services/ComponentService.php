<?php

namespace App\Services;

use App\Models\Component;

class ComponentService
{
    public function create($data): Component
    {
        return Component::create($data);
    }

    public function destroy(Component $component)
    {
        $component->delete();
    }
}