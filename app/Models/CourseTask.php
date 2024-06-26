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
 * Class CourseTask
 *
 * @property string $id
 * @property string $course_id
 * @property string $title
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Course $course
 * @property Collection|CourseTaskAssignee[] $course_task_assignees
 *
 * @package App\Models
 */
class CourseTask extends Model
{
    use SoftDeletes, HasUuids;
    protected $table = 'course_tasks';
    public $incrementing = false;

    protected $fillable = [
        'course_id',
        'title',
        'description',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function course_task_assignees()
    {
        return $this->hasMany(CourseTaskAssignee::class);
    }
}
