<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourseTaskAssignee
 * 
 * @property string $id
 * @property string $course_task_id
 * @property string $student_id
 * @property string $task
 * @property array|null $style
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property CourseTask $course_task
 * @property Student $student
 *
 * @package App\Models
 */
class CourseTaskAssignee extends Model
{
	use SoftDeletes;
	protected $table = 'course_task_assignees';
	public $incrementing = false;

	protected $casts = [
		'style' => 'json'
	];

	protected $fillable = [
		'course_task_id',
		'student_id',
		'task',
		'style'
	];

	public function course_task()
	{
		return $this->belongsTo(CourseTask::class);
	}

	public function student()
	{
		return $this->belongsTo(Student::class);
	}
}
