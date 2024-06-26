<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @property string $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|Lecturer[] $lecturers
 * @property Collection|Student[] $students
 * @property Collection|CourseTask[] $course_tasks
 *
 * @package App\Models
 */
class Course extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'courses';
    public $incrementing = false;

    protected $fillable = [
        'name',
    ];

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class, 'course_lecturers')
            ->withPivot('id', 'deleted_at')
            ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_students')
            ->withPivot('id', 'deleted_at')
            ->withTimestamps();
    }

    public function course_tasks()
    {
        return $this->hasMany(CourseTask::class);
    }
}
