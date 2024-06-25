<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int $role
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Lecturer $lecturer
 * @property Student $student
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasUuids, HasApiTokens, Notifiable, HasFactory, SoftDeletes;
    protected $table = 'users';
    public $incrementing = false;

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'int',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'remember_token',
    ];

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class, 'email', 'email');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'email', 'email');
    }
}
