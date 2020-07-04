<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
			"teacher_id" => $this->teacher_id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "birthday" => $this->birthday,
            "address" => $this->address,
            "contact_number" => $this->contact_number,
            "email" => $this->email
		];
    }
}
