<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'lecturers' => LecturersResource::collection($this->lecturers),
            'students' => StudentsResource::collection($this->students),
            'course_tasks' => CourseTasksResource::collection($this->course_tasks),
            'created_at' => $this->updated_at?->format('c'),
            'updated_at' => $this->updated_at?->format('c'),
        ];
    }

}
