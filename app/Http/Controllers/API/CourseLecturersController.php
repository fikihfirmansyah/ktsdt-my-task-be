<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseLecturerRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Lecturer;

class CourseLecturersController extends Controller
{
    /**
     * Assign a lecturer to a course.
     *
     * @param  \App\Http\Requests\CourseLecturerRequest  $request
     * @param  \App\Models\Course  $course
     * @return \App\Contracts\Response
     */
    public function assignLecturer(CourseLecturerRequest $request, Course $course)
    {
        $data = $request->validated();

        $course->lecturers()->syncWithoutDetaching($data);

        return Response::json(new CourseResource($course),
            'Lecturer assigned to course successfully'
        );
    }

    /**
     * Remove a lecturer from a course.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Lecturer  $lecturer
     * @return \App\Contracts\Response
     */
    public function removeLecturer(Course $course, Lecturer $lecturer)
    {
        $course->lecturers()->detach($lecturer);

        return Response::json(new CourseResource($course),
            'Lecturer removed from course successfully'
        );
    }
}
