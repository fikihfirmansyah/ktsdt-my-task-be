<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourseLecturer
 * 
 * @property string $id
 * @property string $lecturer_id
 * @property string $course_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Course $course
 * @property Lecturer $lecturer
 *
 * @package App\Models
 */
class CourseLecturer extends Model
{
	use SoftDeletes;
	protected $table = 'course_lecturers';
	public $incrementing = false;

	protected $fillable = [
		'lecturer_id',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function lecturer()
	{
		return $this->belongsTo(Lecturer::class);
	}
}
