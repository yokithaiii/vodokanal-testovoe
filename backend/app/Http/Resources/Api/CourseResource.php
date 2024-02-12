<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'teacher' => [
                'id' =>  $this->teacher->id,
                'name' =>  $this->teacher->name,
                'lastname' =>  $this->teacher->lastname,
            ],
            'material' => [
                'id' => $this->materials->first()->id,
                'title' => $this->materials->first()->title,
            ],
            'students' => [
                'count' => count($this->students),
                'items' => $this->students
            ]
        ];
    }
}
