<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
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
            'student' => [
              'id' => $this->student->id,
              'name' => $this->student->name,
              'lastname' => $this->student->lastname,
            ],
            'course' => [
                'id' => $this->course->id,
                'name' => $this->course->name,
            ],
        ];
    }
}
