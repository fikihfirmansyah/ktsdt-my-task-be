<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseTaskResource extends JsonResource
{
    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'course' => new CoursesResource($this->course),
            'course_task_assignees' => CourseTaskAssigneeResource::collection($this->course_task_assignees),
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->updated_at?->format('c'),
            'updated_at' => $this->updated_at?->format('c'),
        ];
    }

}
