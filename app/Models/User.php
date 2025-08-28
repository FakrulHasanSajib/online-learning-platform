<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    } // As a teacher

    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'course_user')->withTimestamps();
    } // As a student

    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user')->withTimestamps();
    }

    public function hasCompleted(Lesson $lesson)
    {
        return $this->completedLessons->contains($lesson);
    }
}