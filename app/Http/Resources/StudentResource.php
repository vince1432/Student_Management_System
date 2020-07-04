<?php

namespace App\Http\Resources;

use App\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "student_id" => $this->student_id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "birthday" => $this->birthday,
            "address" => $this->address,
            "contact_number" => $this->contact_number,
            "course" => $this->course,
            "email" => $this->email
		];
    }
}
