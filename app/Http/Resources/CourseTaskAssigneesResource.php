<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseTaskAssigneeResource extends JsonResource
{
    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'course_task' => new CourseTaskResource($this->courseTask),
            'student' => new StudentResource($this->student),
            'task' => $this->task,
            'style' => $this->style,
            'created_at' => $this->updated_at?->format('c'),
            'updated_at' => $this->updated_at?->format('c'),
        ];
    }

}
