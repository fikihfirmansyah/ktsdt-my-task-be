<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStudentRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\Student;

class CourseStudentsController extends Controller
{
    /**
     * Assign a student to a course.
     *
     * @param  \App\Http\Requests\CourseStudentRequest  $request
     * @param  \App\Models\Course  $course
     * @return \App\Contracts\Response
     */
    public function assignStudent(CourseStudentRequest $request, Course $course)
    {
        $data = $request->validated();

        $course->students()->syncWithoutDetaching($data);

        return Response::json(new CourseResource($course),
            'Student assigned to course successfully'
        );
    }

    /**
     * Remove a student from a course.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Student  $student
     * @return \App\Contracts\Response
     */
    public function removeStudent(Course $course, Student $student)
    {
        $course->students()->detach($student);

        return Response::json(new CourseResource($course),
            'Student removed from course successfully'
        );
    }
}
