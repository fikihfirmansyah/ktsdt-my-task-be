<?php

namespace App\Http\Controllers\API;

use App\Contracts\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \App\Contracts\Response
     */
    public function index()
    {
        return Response::json(StudentResource::collection(Student::all()));
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \App\Http\Requests\StudentRequest  $request
     * @return \App\Contracts\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->validated();

        return Response::okCreated(new StudentResource(Student::create($data)));

    }

    /**
     * Display the specified student.
     *
     * @param  \App\Models\Student  $student
     * @return \App\Contracts\Response
     */
    public function show($student)
    {
        $student = Student::find($student);

        if ($student) {
            return Response::json(new StudentResource($student));
        }

        return Response::abortNotFound();
    }

    /**
     * Update the specified student in storage.
     *
     * @param  \App\Http\Requests\StudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \App\Contracts\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $data = $request->validated();

        $student->update($data);
        return Response::okUpdated(new StudentResource($student));

    }

    /**
     * Remove the specified student from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \App\Contracts\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return Response::noContent();

    }
}
