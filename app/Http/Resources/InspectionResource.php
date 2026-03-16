<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InspectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'inspector_name' => $this->inspector_name,
            'passed' => $this->passed,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
        ];
    }
}
