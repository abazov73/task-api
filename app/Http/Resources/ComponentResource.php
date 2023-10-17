<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sectionIndex' => $this->section_index,
            'accountCount' => $this->characteristics->sum('account_count'),
            'creationDate' => $this->created_at->format('d.m.Y H:i'),
        ];
    }
}
