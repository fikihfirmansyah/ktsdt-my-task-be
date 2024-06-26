<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTaskRequest;
use App\Http\Resources\CourseTaskResource;
use App\Models\CourseTask;

class CourseTaskController extends Controller
{
    /**
     * Display a listing of the courseTasks.
     *
     * @return \App\Contracts\Response
     */
    public function index()
    {
        return Response::json(CourseTaskResource::collection(CourseTask::all()));
    }

    /**
     * Store a newly created courseTask in storage.
     *
     * @param  \App\Http\Requests\CourseTaskRequest  $request
     * @return \App\Contracts\Response
     */
    public function store(CourseTaskRequest $request)
    {
        $data = $request->validated();

        return Response::okCreated(new CourseTaskResource(CourseTask::create($data)));
    }

    /**
     * Display the specified courseTask.
     *
     * @param  \App\Models\CourseTask  $courseTask
     * @return \App\Contracts\Response
     */
    public function show(CourseTask $courseTask)
    {
        $courseTask = CourseTask::find($courseTask);

        if ($courseTask) {
            return Response::json(new CourseTaskResource($courseTask));
        }

        return Response::abortNotFound();
    }

    /**
     * Update the specified courseTask in storage.
     *
     * @param  \App\Http\Requests\CourseTaskRequest  $request
     * @param  \App\Models\CourseTask  $courseTask
     * @return \App\Contracts\Response
     */
    public function update(CourseTaskRequest $request, CourseTask $courseTask)
    {
        $data = $request->validated();

        $courseTask->update($data);
        return Response::okUpdated(new CourseTaskResource($courseTask));
    }

    /**
     * Remove the specified courseTask from storage.
     *
     * @param  \App\Models\CourseTask  $courseTask
     * @return \App\Contracts\Response
     */
    public function destroy(CourseTask $courseTask)
    {
        $courseTask->delete();
        return Response::noContent();
    }
}
