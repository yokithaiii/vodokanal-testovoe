<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $courseId = $this->courses->isNotEmpty() ? $this->courses->first()->course_id : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'email' => $this->email,
            'phone' => $this->phone,
            'course_id' => $courseId,
        ];
    }
}
