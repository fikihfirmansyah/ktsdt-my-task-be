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
 * Class Student
 *
 * @property string $id
 * @property string $email
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property User $user
 * @property Collection|Course[] $courses
 * @property Collection|CourseTaskAssignee[] $course_task_assignees
 *
 * @package App\Models
 */
class Student extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'students';
    public $incrementing = false;

    protected $fillable = [
        'email',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_students')
            ->withPivot('id', 'deleted_at')
            ->withTimestamps();
    }

    public function course_task_assignees()
    {
        return $this->hasMany(CourseTaskAssignee::class);
    }
}
