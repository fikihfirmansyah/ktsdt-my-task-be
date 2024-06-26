<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LecturerRequest;
use App\Http\Resources\LecturerResource;
use App\Models\Lecturer;

class LecturerController extends Controller
{
    /**
     * Display a listing of the lecturers.
     *
     * @return \App\Contracts\Response
     */
    public function index()
    {
        return Response::json(LecturerResource::collection(Lecturer::all()));
    }

    /**
     * Store a newly created lecturer in storage.
     *
     * @param  \App\Http\Requests\LecturerRequest  $request
     * @return \App\Contracts\Response
     */
    public function store(LecturerRequest $request)
    {
        $data = $request->validated();

        return Response::okCreated(new LecturerResource(Lecturer::create($data)));

    }

    /**
     * Display the specified lecturer.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \App\Contracts\Response
     */
    public function show($lecturer)
    {
        $lecturer = Lecturer::find($lecturer);

        if ($lecturer) {
            return Response::json(new LecturerResource($lecturer));
        }

        return Response::abortNotFound();
    }

    /**
     * Update the specified lecturer in storage.
     *
     * @param  \App\Http\Requests\LecturerRequest  $request
     * @param  \App\Models\Lecturer  $lecturer
     * @return \App\Contracts\Response
     */
    public function update(LecturerRequest $request, Lecturer $lecturer)
    {
        $data = $request->validated();

        $lecturer->update($data);
        return Response::okUpdated(new LecturerResource($lecturer));

    }

    /**
     * Remove the specified lecturer from storage.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \App\Contracts\Response
     */
    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return Response::noContent();

    }
}
