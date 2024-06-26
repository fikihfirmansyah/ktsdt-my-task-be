<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTaskAssigneeRequest;
use App\Http\Resources\CourseTaskAssigneeResource;
use App\Models\CourseTaskAssignee;

class CourseTaskAssigneeController extends Controller
{
    /**
     * Display a listing of the courseTaskAssignees.
     *
     * @return \App\Contracts\Response
     */
    public function index()
    {
        return Response::json(CourseTaskAssigneeResource::collection(CourseTaskAssignee::all()));
    }

    /**
     * Store a newly created courseTaskAssignee in storage.
     *
     * @param  \App\Http\Requests\CourseTaskAssigneeRequest  $request
     * @return \App\Contracts\Response
     */
    public function store(CourseTaskAssigneeRequest $request)
    {
        $data = $request->validated();

        return Response::okCreated(new CourseTaskAssigneeResource(CourseTaskAssignee::create($data)));
    }

    /**
     * Display the specified courseTaskAssignee.
     *
     * @param  \App\Models\CourseTaskAssignee  $courseTaskAssignee
     * @return \App\Contracts\Response
     */
    public function show(CourseTaskAssignee $courseTaskAssignee)
    {
        $courseTaskAssignee = CourseTaskAssignee::find($courseTaskAssignee);

        if ($courseTaskAssignee) {
            return Response::json(new CourseTaskAssigneeResource($courseTaskAssignee));
        }

        return Response::abortNotFound();
    }

    /**
     * Update the specified courseTaskAssignee in storage.
     *
     * @param  \App\Http\Requests\CourseTaskAssigneeRequest  $request
     * @param  \App\Models\CourseTaskAssignee  $courseTaskAssignee
     * @return \App\Contracts\Response
     */
    public function update(CourseTaskAssigneeRequest $request, CourseTaskAssignee $courseTaskAssignee)
    {
        $data = $request->validated();

        $courseTaskAssignee->update($data);
        return Response::okUpdated(new CourseTaskAssigneeResource($courseTaskAssignee));
    }

    /**
     * Remove the specified courseTaskAssignee from storage.
     *
     * @param  \App\Models\CourseTaskAssignee  $courseTaskAssignee
     * @return \App\Contracts\Response
     */
    public function destroy(CourseTaskAssignee $courseTaskAssignee)
    {
        $courseTaskAssignee->delete();
        return Response::noContent();
    }
}
