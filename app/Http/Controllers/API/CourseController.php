<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \App\Contracts\Response
     */
    public function index()
    {
        return Response::json(CourseResource::collection(Course::all()));
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \App\Http\Requests\CourseRequest  $request
     * @return \App\Contracts\Response
     */
    public function store(CourseRequest $request)
    {
        $data = $request->validated();

        return Response::okCreated(new CourseResource(Course::create($data)));

    }

    /**
     * Display the specified course.
     *
     * @param  \App\Models\Course  $course
     * @return \App\Contracts\Response
     */
    public function show($course)
    {
        $course = Course::find($course);

        if ($course) {
            return Response::json(new CourseResource($course));
        }

        return Response::abortNotFound();
    }

    /**
     * Update the specified course in storage.
     *
     * @param  \App\Http\Requests\CourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \App\Contracts\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();

        $course->update($data);
        return Response::okUpdated(new CourseResource($course));

    }

    /**
     * Remove the specified course from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \App\Contracts\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return Response::noContent();

    }
}
