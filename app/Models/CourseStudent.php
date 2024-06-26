<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourseStudent
 *
 * @property string $id
 * @property string $student_id
 * @property string $course_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Course $course
 * @property Student $student
 *
 * @package App\Models
 */
class CourseStudent extends Model
{
    use SoftDeletes;
    protected $table = 'course_students';
    public $incrementing = false;

    protected $fillable = [
        'student_id',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
