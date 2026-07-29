<?php

namespace App\Http\Resources;

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
        return [
            'seating_no' => $this->seating_no,

            'arabic_name' => $this->arabic_name,

            'total_degree' => $this->total_degree,

            'percentage' => round(
                ($this->total_degree / 320) * 100,
                2
            ),

            'student_case_desc' => $this->student_case_desc,
        ];
    }
}
